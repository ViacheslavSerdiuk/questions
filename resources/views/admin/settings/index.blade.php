
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
                    <p><h3>Settings</h3> use settings()->set($key, $value); for set specific one</p>
                    <table id="example1" class="table table-bordered table-striped mt-5">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($settings as $key=>$value)
                            <tr>
                                <td>{{$key}}</td>
                                <td>{{$value}}</td>

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