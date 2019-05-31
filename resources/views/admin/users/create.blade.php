@extends('admin.layout')




@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Add new user

            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        {{Form::open(['route'=>'users.store','files'=>'true'])}}
        <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">


                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Passoword</label>
                            <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Avatar</label>
                            <input type="file" name="avatar" id="exampleInputFile">


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