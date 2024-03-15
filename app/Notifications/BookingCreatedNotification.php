<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingCreatedNotification extends Notification
{
    public $booking;
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(bookedconfrenceroom $booking)
    {
        $this->booking = $booking;
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
        Log::info('BookingCreatedNotification sent to: ' . $notifiable->email);

        return (new MailMessage)
            ->line('A new booking has been created.')
            ->line('User Email: ' . $this->booking->user_email)
            ->line('Conference Room: ' . $this->booking->conference_room)
            // Add more lines with the information you want to include
            ->action('View Booking', url('/bookings/' . $this->booking->id));
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
