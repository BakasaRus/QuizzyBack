<?php

namespace App\Http\Controllers;

use App\Question;
use App\Test;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Test::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'questions' => 'required|array'
        ]);

        Test::create($validated);
        $questions = collect(json_decode($validated['questions'], true));
        $questions->transform(function ($item) {
            return Question::create($item);
        });

        return response('', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  Test  $test
     * @return JsonResponse
     */
    public function show(Test $test)
    {
        return response()->json($test->load('questions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Test  $test
     * @return Response
     */
    public function update(Request $request, Test $test)
    {
        return response('', Response::HTTP_NOT_IMPLEMENTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Test  $test
     * @return Response
     * @throws Exception
     */
    public function destroy(Test $test)
    {
        $test->delete();
        return response()->noContent();
    }
}
