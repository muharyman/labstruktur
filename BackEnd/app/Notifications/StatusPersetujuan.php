<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StatusPersetujuan extends Notification
{
    use Queueable;

    /**
     * @var data pengujian
     */
    protected $proyek;
    protected $status;
    /**
     * Create a new notification instance.
     *
     * @param string Proyek
     * @param boolean Status
     * @return void
     */
    public function __construct($proyek, $status)
    {
        $this->proyek = $proyek;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject(env('APP_NAME','labstruktur').' persetujuan pengujian')
                    ->line('Pengujian untuk Proyek '.$this->proyek)
                    ->line($this->status ? 'Disetujui': 'Tidak Disetujui')
                    ->line('Terima kasih');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
