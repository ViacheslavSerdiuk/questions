@extends('admin.layout')


@section('content')

<div class="content-wrapper">


    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Categories</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="form-group">
                    <a href="{{route('categories.create')}}" class="btn btn-success">Add new category</a>
                </div>
                @include('layouts._messages')
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Count questions</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td style="width: 500px">{{$category->title}}</td>
                            <td>{{$category->questions->count()}}</td>
                            <td><a href="{{route('categories.edit',$category->id)}}"><i class="fas fa-edit"></i></a>

                                {{Form::open(['route'=>['categories.destroy',$category->id],'method'=>'delete'])}}
                                <button onclick="return confirm('Are you sure???');" type="submit" class="delete">
                                    <a class="">Remove</a>
                                </button>
                                {{Form::close()}}
                            </td>
                        </tr>
                    @endforeach

                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection;