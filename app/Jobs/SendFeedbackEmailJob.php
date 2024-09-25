<?php

namespace App\Jobs;

use App\Notifications\SendFeedback;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use App\Services\CarCommands\AuthService;
use App\Services\CarCommands\CarApiService;

class SendFeedbackEmailJob implements ShouldQueue
{
    use Queueable;

    protected $email;

    protected array $data;

    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $this->email = 'auto.online@ulf.ua';

        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $message = 'Ім\'я клієнта: ' . $this->data['name'] . '<br>' .
                    'Телефон клієнта: ' . $this->data['phone'] . '<br>'.
                   'Лікар: ' . $this->data['doctor'] . '<br>' .
                   'Клініка: ' . $this->data['clinic']
        ;

        Notification::route('mail', $this->email)->notify(new SendFeedback($this->email, $message));


        $dataForRetailLead = [
            'name' => $this->data['name'],
            'phone' => $this->data['phone'],
        ];
    }
}
