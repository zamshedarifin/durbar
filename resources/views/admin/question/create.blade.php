@extends('admin.layouts.app')
@section('title','Add Question')

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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <div class="card-box">
                    <h5 class="mt-0 font-14 mb-3 text-uppercase">Add Question form</h5>
                    <form action="{{route('admin.create.question')}}" method="post" class="form-row">@csrf
                        <div class="form-group col-md-8">
                            <label for="question">Question</label>
                            <input type="text" value="{{old('question')}}" class="form-control @error('question') is-invalid @enderror"
                                   name="question" id="question">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="quiz">Quiz</label>
                            <select name="quiz" id="quiz" class="form-control @error('quiz') is-invalid @enderror">
                                <option value="" selected disabled>Choose...</option>
                                @if($quizzes)
                                    @foreach($quizzes as $quiz)
                                        <option value="{{$quiz->id}}" {{old('quiz')==$quiz->id?'selected':''}}>{{$quiz->title}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="option">Option 1</label>
                            <input type="text" value="{{old('option_one')}}" class="form-control @error('option_one') is-invalid @enderror" name="option_one" id="option">
                            <input type="radio" name="answer[4]" value="1" > correct answer.
                        </div>
                        <div class="form-group col-md-6">
                            <label for="option">Option 2</label>
                            <input type="text" value="{{old('option_two')}}" class="form-control @error('option_two') is-invalid @enderror" name="option_two" id="question">
                            <input type="radio" name="answer[4]" value="2" > correct answer.
                        </div>
                        <div class="form-group col-md-6">
                            <label for="option">Option 3</label>
                            <input type="text" value="{{old('option_three')}}" class="form-control @error('option_three') is-invalid @enderror" name="option_three" id="question">
                            <input type="radio" name="answer[4]" value="3" > correct answer.
                        </div>
                        <div class="form-group col-md-6">
                            <label for="option">Option 4</label>
                            <input type="text" value="{{old('option_four')}}" class="form-control @error('option_four') is-invalid @enderror" name="option_four" id="question">
                            <input type="radio" name="answer[4]" value="4" > correct answer.
                        </div>

{{--                        <div class="form-group col-md-12">--}}
{{--                            <label for="answer">Answer</label>--}}
{{--                            <input type="text" value="{{old('answer')}}" class="form-control @error('answer') is-invalid @enderror" name="answer" id="answer">--}}
{{--                        </div>--}}
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

@section('js')
    <script>
        $(document).ready(function () {
            // $('input[type=radio]').prop('checked', false);
            // $('input[type=radio]:first').prop('checked', false)

            $('input[type=radio]').click(function (event) {
                $('input[type=radio]').prop('checked', false);
                $(this).prop('checked', true);

                //event.preventDefault();
            });
        });
    </script>
@stop
