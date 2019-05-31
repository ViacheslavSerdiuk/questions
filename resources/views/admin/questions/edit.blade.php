@extends('admin.layout')

@section('content')



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="width: 90%">


        <!-- Main content -->
        <section class="content">
        {{Form::open([
        'route' => ['admin.questions.update',$question->id],
        'method' => 'put'
        ])}}
        <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Update Question</h3>

                </div>
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                   value="{{$question->title}}" name="title">
                        </div>


                        <div class="form-group">
                            <label>Category</label>

                            {{Form::select('category_id',
                           $category,
                            $question->category_id,
                            ['class'=>'form-control select2']
                            )}}
                        </div>
                        <div class="form-group">


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Body</label>
                                    <textarea name="body" cols="30" rows="10" class="form-control">
                                {{$question->body}}
              </textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer ml-3">
                            <a class="btn btn-outline-secondary" href="{{route('admin.questions.index')}}">Back</a>
                            <button class="btn btn-outline-secondary pull-right">Apply</button>
                        </div>
                        <!-- /.box-footer-->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



@endsection