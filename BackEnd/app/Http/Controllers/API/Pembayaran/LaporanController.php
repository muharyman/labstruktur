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
            'date' => ['nullable','date'], 
        ]);
        if ($validator->fails()){
            return $this->respondRequestError($validator->errors());
        }

        // get data
        $endDate = $request->input('date') ? CarbonImmutable::createFromFormat('Y-m-d', $request->input('date')) : CarbonImmutable::now();
        $startDate = $endDate->subMonth()->toDateString();
        $endDate = $endDate->toDateString();

        $data = Pembayaran::dateBetween($startDate, $endDate)
        ->with([
            'pengujian',
            'pengujian.itemPengujian',
            'pengujian.teknisi',
            'pengujian.engineer',
        ])->get();
        $data = $data->map(function ($item, $key){
            $item ['pengujian']['total_biaya'] = $item['pengujian']['itemPengujian']->sum('biaya_per_pengujian');
            return $item;
        });
        $sum = $data->sum('jumlah_pembayaran');

        // return view('LaporanBulanan', ['data'=>$data, 'sum'=>$sum]);
        //generate pdf
        $pdf = PDF::loadView('LaporanBulanan', ['data'=>$data, 'sum'=>$sum]);
        return $pdf->stream();
    }
}