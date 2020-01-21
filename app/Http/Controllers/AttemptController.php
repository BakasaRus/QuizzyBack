<?php

namespace App\Http\Controllers;

use App\Question;
use App\Test;
use App\UserQuestion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AttemptController extends Controller
{
    /**
     * Save user's attempt
     *
     * @param  Request  $request
     * @param  Test  $test
     * @return Response
     */
    public function store(Request $request, Test $test)
    {
        $validated = $request->validate([
            'answers' => 'required|array'
        ]);

        $valid_questions = $test->questions->pluck('id');
        $answers = collect($validated['answers']);
        $user = Auth::user();
        $score = $answers->reduce(function ($total, $item) use ($valid_questions, $user) {
            if (!$valid_questions->contains($item['id'])) {
                return $total;
            }

            $question = Question::whereId($item['id'])->first();
            $user_answer = $item['answer'];

            if ($question->correct_answer == $user_answer) {
                $user->answers()->attach($item['id'], [
                    'answer' => $user_answer,
                    'is_correct' => true
                ]);
                return $total + $question->points;
            } else {
                $user->answers()->attach($item['id'], [
                    'answer' => $user_answer,
                    'is_correct' => false
                ]);
                return $total;
            }
        }, 0);

        $test->users()->attach($user->id, [
            'score' => $score
        ]);

        return response('', Response::HTTP_CREATED);
    }
}
