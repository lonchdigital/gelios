<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class SendFeedback extends Notification
{
    use Queueable;

    protected string $message = '';

    /**
     * Create a new notification instance.
     */
    public function __construct($email, $text)
    {
        $this->message = $text;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        Log::info($this->message);
        return (new MailMessage)
                ->subject('Нове повідомлення')
                ->view('emails.feedback', ['message2' => (string) $this->message]);
        // $lines = explode("\n", $this->message);
        // $mailMessage = new MailMessage;

        // foreach ($lines as $line) {
        //     $mailMessage->line($line);
        // }

        // return $mailMessage;

        // return (new MailMessage)
        //             ->line($this->message);
                    // ->line('The introduction to the notification.')
                    // ->action('Notification Action', url('/'))
                    // ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
