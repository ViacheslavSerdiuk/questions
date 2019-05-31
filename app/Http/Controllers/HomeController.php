<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');

    }


    public function category($slug)
    {
     //   dd($slug);

        $category = Category::where('slug', $slug)->firstOrFail();

        $questions = $category->questions()->paginate(10);

        return view('questions.index',compact('questions'));
    }
}
