<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class WorkorderAssigned extends Notification implements ShouldQueue
{
    use Queueable;

    public $workorder;

    public function __construct($workorder)
    {
        $this->workorder = $workorder;
    }

    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Anda telah ditugaskan untuk work order baru.')
                    ->action('Lihat Work Order', url('/workorders/' . $this->workorder->id))
                    ->line('Terima kasih telah menggunakan aplikasi kami!');
    }

    public function toArray($notifiable)
    {
        return [
            'workorder_id' => $this->workorder->id,
            'name' => $this->workorder->name,
            'email' => $this->workorder->email,
            'phone' => $this->workorder->phone,
            'service_items' => $this->workorder->service_items,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'workorder_id' => $this->workorder->id,
            'name' => $this->workorder->name,
            'email' => $this->workorder->email,
            'phone' => $this->workorder->phone,
            'service_items' => $this->workorder->service_items,
        ]);
    }
}

//ini untuk controller jika assign ke tknisi
// use App\Models\Workorder;
// use App\Models\User;
// use App\Notifications\WorkorderAssigned;

// // Asumsikan $workorder adalah instance dari Workorder yang telah ditetapkan kepada teknisi
// // Asumsikan $technician adalah instance dari User yang merupakan teknisi
// $technician->notify(new WorkorderAssigned($workorder));

