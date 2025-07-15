<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feedback\StoreQuestionRequest;
use App\Http\Requests\Feedback\StoreRequest;
use App\Http\Requests\Feedback\StoreVacancyRequest;
use App\Jobs\SendFeedbackEmailJob;
use App\Jobs\SendVacancyEmailJob;
use App\Models\Contact;
use App\Models\LeadRequest;
use App\Services\Site\LeadAppService;
use App\Services\Site\VacancyAppService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $data['form'] = 'Записатися на прийом';
        $data['clinic'] = Contact::find($data['clinic'])->title;
        // $data['url'] = request()->headers->get('referer');
        $referer = $request->server('HTTP_REFERER') ?? '';
        $url = $referer ? parse_url($referer, PHP_URL_PATH) : '';
        $data['url'] = url($url);

        $referer = request()->headers->get('referer');

        if ($referer) {
            $query = parse_url($referer, PHP_URL_QUERY);
            parse_str($query, $params);
        } else {
            $params = [];
        }

        $utm_source   = $params['utm_source']   ?? '';
        $utm_medium   = $params['utm_medium']   ?? '';
        $utm_campaign = $params['utm_campaign'] ?? '';
        $utm_term     = $params['utm_term']     ?? '';
        $utm_content  = $params['utm_content']  ?? '';

        // $utmSource = request()->query('utm_source');
        // $utmMedium = request()->query('utm_medium');
        // $utmCampaign = request()->query('utm_campaign');
        // $utmTerm = request()->query('utm_term');
        // $utmContent = request()->query('utm_content');

        $data['utm_source'] = $utm_source ?? '';
        $data['utm_medium'] = $utm_medium ?? '';
        $data['utm_campaign'] = $utm_campaign ?? '';
        $data['utm_term'] = $utm_term ?? '';
        $data['utm_content'] = $utm_content ?? '';

        dispatch(new SendFeedbackEmailJob($data));
Log::info($data);
        $service = resolve(LeadAppService::class);

        $service->store([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'doctor_specialist' => $data['doctor'],
            'clinic_name' => $data['clinic'],
            'type' => $data['form'],
        ]);

        return response()->json(['success' => true]);
    }

    public function storeQuestion(StoreQuestionRequest $request)
    {
        $data = $request->validated();

        $data['form'] = 'Залишилися запитання';

        $referer = $request->server('HTTP_REFERER') ?? '';
        $url = $referer ? parse_url($referer, PHP_URL_PATH) : '';
        $data['url'] = url($url);

        $referer = request()->headers->get('referer');

        if ($referer) {
            $query = parse_url($referer, PHP_URL_QUERY);
            parse_str($query, $params);
        } else {
            $params = [];
        }

        $utm_source   = $params['utm_source']   ?? '';
        $utm_medium   = $params['utm_medium']   ?? '';
        $utm_campaign = $params['utm_campaign'] ?? '';
        $utm_term     = $params['utm_term']     ?? '';
        $utm_content  = $params['utm_content']  ?? '';

        $data['utm_source'] = $utm_source ?? '';
        $data['utm_medium'] = $utm_medium ?? '';
        $data['utm_campaign'] = $utm_campaign ?? '';
        $data['utm_term'] = $utm_term ?? '';
        $data['utm_content'] = $utm_content ?? '';
Log::info($data);
        dispatch(new SendFeedbackEmailJob($data));

        $service = resolve(LeadAppService::class);

        $service->store([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'type' => 'Залишились питання',
        ]);

        return response()->json(['success' => true]);
    }

    public function storeVacancy(StoreVacancyRequest $request)
    {
        $data = $request->validated();

        $service = resolve(VacancyAppService::class);

        $service->store($data);

        $data['form'] = 'Вакансія';
        $referer = $request->server('HTTP_REFERER') ?? '';
        $url = $referer ? parse_url($referer, PHP_URL_PATH) : '';
        $data['url'] = url($url);

        $referer = request()->headers->get('referer');

        if ($referer) {
            $query = parse_url($referer, PHP_URL_QUERY);
            parse_str($query, $params);
        } else {
            $params = [];
        }

        $utm_source   = $params['utm_source']   ?? '';
        $utm_medium   = $params['utm_medium']   ?? '';
        $utm_campaign = $params['utm_campaign'] ?? '';
        $utm_term     = $params['utm_term']     ?? '';
        $utm_content  = $params['utm_content']  ?? '';

        $data['utm_source'] = $utm_source ?? '';
        $data['utm_medium'] = $utm_medium ?? '';
        $data['utm_campaign'] = $utm_campaign ?? '';
        $data['utm_term'] = $utm_term ?? '';
        $data['utm_content'] = $utm_content ?? '';
Log::info($data);

        dispatch(new SendVacancyEmailJob($data));

        return response()->json(['success' => true]);
    }
}
