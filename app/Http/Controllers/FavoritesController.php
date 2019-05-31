<?php

namespace App\Http\Controllers;

use App\Question;
use foo\bar;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(Request $request,Question $question)
    {
        $question->favorites()->attach(auth()->id());

        if($request->expectsJson()){
            return response()->json(null,204);
        }

        return back();
    }

    public function destroy(Request $request, Question $question)
    {
        $question->favorites()->detach(auth()->id());

        if($request->expectsJson()){
            return response()->json(null,204);
        }

        return back();

    }


}
