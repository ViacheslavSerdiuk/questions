@extends('admin.layout')
<!-- Content Wrapper. Contains page content -->


@section('content')
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            {!! Form::open(['route' => 'categories.store']) !!}
            <div class="box-header with-border">
                <h3 class="box-title">Add category for question</h3>
                <div class="box-header">

                    @include('layouts._messages')
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="title">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer ml-3">
                <a class="btn btn-outline-secondary" href="{{route('categories.index')}}">Back</a>
                <button class="btn btn-outline-secondary pull-right">Add new</button>
            </div>
            <!-- /.box-footer-->
            {!! Form::close() !!}
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection;
