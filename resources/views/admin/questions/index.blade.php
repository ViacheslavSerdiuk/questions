
@extends('admin.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header">

                    @include('layouts._messages')
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Answers</th>
                            <th>Views</th>
                            <th>Category</th>
                            <th>Vote</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($questions as $question)
                            <tr>
                                <td>{{$question->id}}</td>
                                <td>{{$question->title}}</td>
                                <td>{{$question->answers->count()}}</td>
                                <td>{{$question->views}}</td>
                                <td>{{$question->getCategoryTitle()}}</td>
                                <td>{{$question->votes_count}}</td>

                                <td>
                                    <a href="{{route('admin.questions.edit',$question->id)}}"><i class="fas fa-edit"></i></a>
                                    {{Form::open(['route'=>['admin.questions.delete',$question->id],'method'=>'delete'])}}
                                    <button onclick="return confirm('Are you sure???');" type="submit" class="delete">
                                        Remove
                                    </button>
                                {{Form::close()}}
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
@endsection