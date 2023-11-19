<?php

namespace App\Http\Controllers;

use App\Events\CommentWritten;
use App\Models\Achievement;
use App\Models\Comment;
use App\Models\UserAchievement;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function addComment(Request $request){
        // try{

            $validator= Validator::make($request->all(),[
                'body' => 'required',
            ]);

            if ($validator->fails()) {
                $fieldsWithErrorMessagesArray = $validator->errors()->all();
                return response()->json($fieldsWithErrorMessagesArray, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $comment = Comment::query()->create([
                'body' => $request->body,
                'user_id' => Auth::user()->id,
            ]);

            event( new CommentWritten($comment));

            return response()->json($comment, Response::HTTP_OK);

        // }catch (\Exception $exception){
        //     return response()->json($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        // }
    }
}
