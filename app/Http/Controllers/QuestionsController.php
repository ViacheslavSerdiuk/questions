<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Category;
use App\Http\Requests\AskQuestionRequest;
use App\Providers\DateCheckServiceProvider;
use App\Question;
use App\Services\Contracts\CustomServiceInterface;
use App\Services\DateCheck;
use App\Services\DateCheckNew;
use App\User;
use Illuminate\Http\Request;


class QuestionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $questions = Question::with('user')->latest()->paginate(5);
        return view('questions.index',compact('questions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $question = new Question();
         $category = Category::pluck('title','id')->all();
         return view('questions.create',['question'=>$question, 'category'=>$category]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {



         $question = $request->user()->questions()->create($request->only('title','body'));
         $question->setCategory($request->get('category_id'));

      return redirect()->route('questions.index')->with('success','Your message has been submitted');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {

     //   dd($customService->test());
        $question->increment('views');
        return view('questions.show',compact('question'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {

        $this->authorize("update",$question);
        $category = Category::pluck('title','id')->all();
        return view("questions.edit",['question'=>$question, 'category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {

        $this->authorize("update",$question);

        $question->setCategory($request->get('category_id'));
        $question->update($request->only('title', 'body'));
        if($request->expectsJson()){

            return response( )->json([
                'message'=>'Your question has been updated',
                'body_html' =>$question->body_html

            ]);
        }
        return redirect('/questions')->with('success', 'Your question has been updated');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $this->authorize("delete",$question);

        $question->delete();

        if(\request()->expectsJson()){

            return response( )->json([
                'message'=>'Your question has been deleted',

            ]);
        }

        return redirect('/questions')->with('success', 'Your question has been deleted');
    }
}
