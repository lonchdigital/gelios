<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feedback\StoreQuestionRequest;
use App\Http\Requests\Feedback\StoreRequest;
use App\Jobs\SendFeedbackEmailJob;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $data['form'] = 'Записатися на прийом';
        $data['clinic'] = Contact::find($data['clinic'])->title;
        $data['url'] = request()->headers->get('referer');

        $utmSource = request()->query('utm_source');
        $utmMedium = request()->query('utm_medium');
        $utmCampaign = request()->query('utm_campaign');
        $utmTerm = request()->query('utm_term');
        $utmContent = request()->query('utm_content');

        $data['utm_source'] = $utmSource ?? '';
        $data['utm_medium'] = $utmMedium ?? '';
        $data['utm_campaign'] = $utmCampaign ?? '';
        $data['utm_term'] = $utmTerm ?? '';
        $data['utm_content'] = $utmContent ?? '';

        dispatch(new SendFeedbackEmailJob($data));

        return response()->json(['success' => true]);
    }

    public function storeQuestion(StoreQuestionRequest $request)
    {
        $data = $request->validated();

        dispatch(new SendFeedbackEmailJob($data));

        return response()->json(['success' => true]);
    }
}
