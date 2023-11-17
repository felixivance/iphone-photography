<?php

namespace App\Http\Controllers;

use App\Events\LessonWatched;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
//    create new lesson watched instance
    public function addWatchedLesson(Request $request){
        try{
            $validator= Validator::make($request->all(),[
                'lesson_id' => 'required|exists:lessons,id',
            ]);

            if ($validator->fails()) {
                $fieldsWithErrorMessagesArray = $validator->errors()->all();
                return response()->json($fieldsWithErrorMessagesArray, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $user = User::query()->where('id',Auth::id())->first();
            $lesson = Lesson::query()->where('id',$request->lesson_id)->first();
            $user->watched()->attach($lesson, ['watched' => true]);

            event(new LessonWatched($lesson, $user));

            return response()->json('Lesson watched added successfully', 200);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), 500);
        }
    }
}
