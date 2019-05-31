@extends('admin.layout')




@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Change user profile
                <small>....</small>
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        {{Form::open([
           'route'=>['users.update',$user->id],
           'method'=>'put',
           'files'=>'true'
        ])}}
        <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">


                </div>
                <div class="box-body d-flex">
                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="text" name = "email" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$user->email}}">
                        </div>

                        <div class="form-group">
                            <img src="{{$user->getImage()}}" alt="" width="200" class="img-responsive">
                            <label for="exampleInputFile">Avatar</label>
                            <input type="file" id="image" name="avatar" class="mt-5">

                        </div>


                    </div>
                    <div class="col-md-3"></div>
                    <div class="col-md-3">
                        <div class="mt-5">
                            <div class="font-weight-bold">{{$user->countQuestions()}}</div>  Questions
                        </div>

                        <div class="mt-5">
                            <div class="font-weight-bold">{{$user->countAnswers()}}</div> Answers
                        </div>


                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer ml-3">
                    <a class="btn btn-outline-secondary" href="{{route('users.index')}}">Back</a>
                    <button class="btn btn-outline-secondary pull-right">Apply</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
            {{Form::close()}}
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection


