<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feedback\StoreRequest;
use App\Jobs\SendFeedbackEmailJob;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        dispatch(new SendFeedbackEmailJob($data));

        return response()->json(['success' => true]);
    }
}
