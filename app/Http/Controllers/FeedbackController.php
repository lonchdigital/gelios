<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feedback\StoreQuestionRequest;
use App\Http\Requests\Feedback\StoreRequest;
use App\Jobs\SendFeedbackEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

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
