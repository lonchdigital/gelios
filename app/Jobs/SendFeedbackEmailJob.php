<?php

namespace App\Jobs;

use App\Models\Setting;
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
        $this->email = Setting::where('key', 'lead_email')
            ->first()
            ->value ?? 'test@test.com';

        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $message = 'Ім\'я клієнта: ' . $this->data['name'] . "\n" .
                    'Телефон клієнта: ' . $this->data['phone'] . "\n".
                   'Спеціальність: ' . $this->data['doctor'] . "\n" .
                   'Клініка: ' . $this->data['clinic'] . "\n" .
                   'Сторінка: ' . $this->data['url'] . "\n" .
                   'Форма: ' . $this->data['form'] . "\n" .
                   'utm_source: ' . $this->data['utm_source'] . "\n" .
                   'utm_medium: ' . $this->data['utm_medium'] . "\n" .
                   'utm_campaign: ' . $this->data['utm_campaign'] . "\n" .
                   'utm_term: ' . $this->data['utm_term'] . "\n" .
                   'utm_content: ' . $this->data['utm_content']

        ;

        Notification::route('mail', $this->email)->notify(new SendFeedback($this->email, $message));

        // $dataForRetailLead = [
        //     'name' => $this->data['name'],
        //     'phone' => $this->data['phone'],
        // ];
    }
}
