@extends('admin.layouts.app')
@section('title','Import CSV')

@section('css')

@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12">
                @if($message = Session::get('success'))
                    <div class="alert alert-icon alert-success text-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="mdi mdi-check-all mr-2"></i>
                        <strong>Success!</strong> {{$message}}
                    </div>
                @endif

                <div class="card-box">
                    <h5 class="mt-0 font-14 mb-3 text-uppercase">Add Question from CSV</h5>
                    <form action="{{route('admin.question.import')}}" method="post" class="form-row" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-6">
                            <label for="quiz_id">Select Quiz</label>
                            <select name="quiz_id" id="quiz_id" class="form-control @error('quiz_id') is-invalid @enderror">
                                <option value="" selected disabled>Choose...</option>
                                @if($quizzes)
                                    @foreach($quizzes as $quiz)
                                        <option value="{{$quiz->id}}" {{old('quiz')==$quiz->id?'selected':''}}>{{$quiz->title}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="option">CSV File <span class="text-danger">*</span></label>
                            <input type="file"  class="form-control @error('option.0') is-invalid @enderror" name="file" id="option">
                        </div>

                        <div class="col-12 d-flex justify-content-center">
                            <button class="btn btn-primary btn-sm"><i class="fa fa-save"></i> SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@stop

