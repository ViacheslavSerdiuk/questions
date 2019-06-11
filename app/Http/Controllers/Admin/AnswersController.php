<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnswersController extends Controller
{
    public function index()
    {
        $answers  = Answer::all();

        return view('admin.answers.index',['answers'=>$answers]);
    }


    public function destroy($id)
    {
        $answer = Answer::find($id);
        $answer->delete();
        return redirect()->back()->with('success', 'Answer has been deleted');
    }
}
