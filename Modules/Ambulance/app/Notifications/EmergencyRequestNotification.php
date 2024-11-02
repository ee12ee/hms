<?php

namespace Modules\Ambulance\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmergencyRequestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($request)
    {
        $this->request=$request;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
//    public function toMail($notifiable): MailMessage
//    {
//        return (new MailMessage)
//            ->line('The introduction to the notification.')
//            ->action('Notification Action', 'https://laravel.com')
//            ->line('Thank you for using our application!');
//    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable): array
    {
        return [
            'patient_name'=>$this->request->patient_name,
            'patient_contact'=>$this->request->patient_contact,
            'location'=>$this->request->location,
            'emergency_type'=>$this->request->emergency_type,
        ];
    }
}
