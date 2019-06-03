@extends('layouts.app')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">

                    <div class="profile mt-5"><!--leave comment-->
                        <img src="{{$user->getImage()}}" alt="" class="profile-image">


                        <div class="ml-5">
                           <h2>{{$user->name}}</h2>
                            <div>Apparently, this user prefers to keep an air of mystery about them.</div>
                         </div>


                    </div><!--end leave comment-->

                </div>

                <div class="col-md-4">
                    <div class="mt-5">
                        <div class="font-weight-bold">{{$user->countQuestions()}}</div>  Questions
                    </div>

                    <div class="mt-5">
                        <div class="font-weight-bold">{{$user->countAnswers()}}</div> Answers
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col-md-12 mt-5">
                      <p>Most Popular Questions posted by User</p>

                    <div class="bg-white">
                    @foreach($questions as $question)
                        <div class="d-flex profile-last-q">
                        <p>View : {{$question->views}} &nbsp;</p>
                        <a href="{{$question->url}}">
                            <p class="">{{$question->title}}</p></a>
                         <p>{{$question->created_at}}</p>
                    </div>
                    @endforeach
                    </div>
                </div>

            </div>


        </div>
    </div>
    <!-- end main content-->



@endsection
