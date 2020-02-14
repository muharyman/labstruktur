<?php

namespace App\Http\Controllers\API\Pembayaran;

use App\Http\Controllers\API\APIController;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Pengujian;
use Carbon\CarbonImmutable;
use Validator;
use PDF;

class LaporanController extends APIController
{
    /**
     * generate laporan bulanan
     * 
     * @param 
     * @return pdf
     */
    public function laporanBulanan(Request $request){
        // validate request
        $validator = Validator::make($request->all(), [
            'rutin' => ['nullable', 'boolean'],
            'date' => ['nullable','date'], 
        ]);
        if ($validator->fails()){
            return $this->respondRequestError($validator->errors());
        }

        // get data
        $rutin = $request->input('rutin') ?? true;

        $endDate = $request->input('date') ? CarbonImmutable::createFromFormat('Y-m-d', $request->input('date')) : CarbonImmutable::now();
        $startDate = $endDate->subMonth()->toDateString();
        $endDate = $endDate->toDateString();

        $data = $rutin ? Pengujian::rutin() : Pengujian::nonRutin();
        $data = $data->whereHas('pembayaran', function($query) use ($startDate, $endDate){
            $query->dateBetween($startDate, $endDate);
        })->with([
            'pembayaran',
            'itemPengujian',
            'teknisi',
            'engineer',
        ])->get();
        $data = $data->map(function ($item, $key){
            $item['total_biaya'] = $item['itemPengujian']->sum('biaya_per_pengujian');
            $item['total_pembayaran'] = $item['pembayaran']->sum('jumlah_pembayaran');
            return $item;
        });
        $sum = $this->countSum($data, $startDate, $endDate);
     
        //generate pdf
        $pdf = PDF::setPaper('a4','landscape')
        ->loadView('LaporanBulanan', [
            'data'=>$data, 
            'sum'=>$sum, 
            'start'=>$startDate, 
            'end'=>$endDate, 
            'rutin'=>$rutin]);
        return $pdf->stream();
    }

    /**
     * generate kuitansi
     * 
     * @param 
     * @return pdf
     */
    public function kuitansi($id)
    {
        //check pembayaran exist
        $pembayaran = Pembayaran::with([
            'pengujian',
            'pengujian.engineer',
            'pengujian.itemPengujian.jenisPengujian.kategoriPengujian',
        ])->find($id);
        if(!$pembayaran){
            return $this->respondError('pembayaran not found');
        }
        $terbilang = ucfirst($this->terbilang($pembayaran->jumlah_pembayaran)).' rupiah';
        $itemPengujian = '';
        foreach ($pembayaran['pengujian']['itemPengujian'] as $item) {
            $itemPengujian .= html_entity_decode($item->jenisPengujian->nama_pengujian).' - '.$item->jenisPengujian->kategoriPengujian->nama_lain.' ('.$item->jumlah_item.' sampel); ';
        }

        return view('Kuitansi', ['pembayaran'=>$pembayaran, 'terbilang'=>$terbilang, 'itemPengujian'=>$itemPengujian]);
    }

    /**
     * sum pembayaran
     */
    private function countSum($data, $startDate, $endDate)
    {
        $sum = 0;
        foreach($data as $d){
            foreach($d['pembayaran'] as $pembayaran){
                if ($pembayaran['tanggal_pembayaran']<$endDate && $pembayaran['tanggal_pembayaran']>$startDate){
                    $sum += $pembayaran['jumlah_pembayaran'];
                }
            }
        }
        return $sum;
    }

    private function bilangRatusan($x)
	{
		// function untuk membilang bilangan pada setiap kelompok
		$kata = array('', 'satu ', 'dua ', 'tiga ' , 'empat ', 'lima ', 'enam ', 'tujuh ', 'delapan ', 'sembilan ');

		$string = '';
		$ratusan = floor($x/100);
		$x = $x % 100;
		if ($ratusan > 1) $string .= $kata[$ratusan]."ratus "; // membentuk kata '... ratus'
	   	else if ($ratusan == 1) $string .= "seratus "; // membentuk kata khusus 'seratus '
		$puluhan = floor($x/10);
		$x = $x % 10;
		if ($puluhan > 1){
			$string .= $kata[$puluhan]."puluh "; // membentuk kata '... puluh'
			$string .= $kata[$x]; // membentuk kata untuk satuan
		}
		else if (($puluhan == 1) && ($x > 0)) $string .= $kata[$x]."belas "; // kejadian khusus untuk bilangan yang berbentuk kata '... belas'
		else if (($puluhan == 1) && ($x == 0)) $string .= $kata[$x]."sepuluh "; // kejadian khusus untuk bilangan 10
		else if ($puluhan == 0) $string .= $kata[$x];	 // membentuk kata untuk satuan
		return $string;
    }
    
	private function terbilang($x)
	{
		// membentuk format bilangan XXX.XXX.XXX.XXX.XXX
		$x = number_format($x, 0, "", ".");
		// memecah kelompok ribuan berdasarkan tanda '.'
		$pecah = explode(".", $x);
		$string = "";
		
		// membentuk format terbilang '... trilyun ... milyar ... juta ... ribu ...'
		for($i = 0; $i <= count($pecah)-1; $i++){
			if ((count($pecah) - $i == 5) && ($pecah[$i] != 0)) $string .= $this->bilangRatusan($pecah[$i])."triliyun "; // membentuk kata '... trilyun'
			else if ((count($pecah) - $i == 4) && ($pecah[$i] != 0)) $string .= $this->bilangRatusan($pecah[$i])."milyar "; // membentuk kata '... milyar'
			else if ((count($pecah) - $i == 3) && ($pecah[$i] != 0)) $string .= $this->bilangRatusan($pecah[$i])."juta "; // membentuk kata '... juta'
			else if ((count($pecah) - $i == 2) && ($pecah[$i] == 1)) $string .= "seribu "; // kejadian khusus untuk bilangan dalam format 1XXX (yang mengandung kata 'seribu')
			else if ((count($pecah) - $i == 2) && ($pecah[$i] != 0)) $string .= $this->bilangRatusan($pecah[$i])."ribu "; // membentuk kata '... ribu'
			else if ((count($pecah) - $i == 1) && ($pecah[$i] != 0)) $string .= $this->bilangRatusan($pecah[$i]);
		}
		return $string;
	}
}