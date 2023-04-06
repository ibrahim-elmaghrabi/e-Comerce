<?php

namespace App\Http\Controllers\Api\Mobile;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CommentRequest;

class CommentController extends Controller
{
    use ApiResponse;

    public function __invoke(CommentRequest $request)
    {
        Comment::create($request->validated()+['user_id' => auth()->user()->id]);
        return $this->apiResponse(1, "your Comment added Successfully");

    }
}
