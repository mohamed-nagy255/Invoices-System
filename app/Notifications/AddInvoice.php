<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AddInvoice extends Notification
{
    use Queueable;
    private $invoice_id;

    public function __construct($invoice_id)
    {
        $this -> invoice_id = $invoice_id;
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = 'http://127.0.0.1:8000/invoice_details/' . $this -> invoice_id;
        return (new MailMessage)
            ->greeting('مرحباٌ')
            ->subject('اضافة فاتورة جديدة')
            ->line('تم اضافة فاتورة جديدة')
            ->action('عرض الفاتورة', $url)
            ->line('شكرا لاستخدامك نظام الفاتورة!');
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'id' => $this -> invoice_id ,
            'title' => 'تم اضافة فاتورة بواسطة : ',
            'usre' => Auth::user()->name,
            
        ];
    }
}
