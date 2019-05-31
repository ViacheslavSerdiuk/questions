@extends('admin.layout')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Change category</h3>



            </div>
            <div class="box-body">
                {{Form::open(['route'=>['categories.update', $category->id],'method'=>'put'])}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="title" placeholder="" value="{{$category->title}}">
                    </div>
                </div>


            <div class="box-footer ml-3">
                <a class="btn btn-outline-secondary" href="{{route('categories.index')}}">Back</a>
                <button class="btn btn-outline-secondary pull-right">Apply</button>
            </div>
            <!-- /.box-footer-->
            {{Form::close()}}
            </div>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->





@endsection