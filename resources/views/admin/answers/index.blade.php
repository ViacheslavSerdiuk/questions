
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

                    <table id="example1" class="table table-bordered table-striped mt-5">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Body</th>
                            <th>Votes Count</th>

                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($answers as $answer)

                            <tr>
                                <td>{{$answer->id}}</td>
                                <td>{{$answer->excerpt(100)}}</td>
                                <td>{{$answer->votes_count}}</td>

                                {{--<td>
                                    <a href="{{route('admin.questions.edit',$question->id)}}"><i class="fas fa-edit"></i></a>
                                    {{Form::open(['route'=>['admin.questions.delete',$question->id],'method'=>'delete'])}}
                                    <button onclick="return confirm('Are you sure???');" type="submit" class="delete">
                                        Remove
                                    </button>
                                {{Form::close()}}--}}
                                <td>

                                    {{Form::open(['route'=>['admin.answers.destroy',$answer->id],'method'=>'delete'])}}
                                <button onclick="return confirm('Are you sure???');" type="submit" class="delete">
                                    <a class="">remove</a>
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
@endsection
