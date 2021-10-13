@extends('admin.layouts.app')
@section('title','Manage Questions')
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
                    <h5 class="mt-0 font-14 mb-1 text-center text-uppercase">Manage Questions</h5>
                    <div class="col-md-2 p-1">
{{--                        <a href="{{route('admin.question.import')}}" class="btn btn-success btn-sm text-white font-weight-bold"><i class="fa fa-file"></i> CSV File Import</a>--}}
                    </div>
                <div class="table-responsive">
                    <table id="example" class="display table table-bordered table-hover mails m-0 table table-actions-bar table-centered">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center">S.L</th>
                            <th>Question</th>
                            <th>Quiz</th>
                            <th>Option 1</th>
                            <th>Option 2</th>
                            <th>Option 3</th>
                            <th>Option 4</th>
                            <th width="11%">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(@count($questions)>0)
                            @foreach($questions as $key=>$question)
                                <tr>
                                    <td class="text-center"><b>{{$questions->firstItem()+$key}}</b>.</td>
                                    <td>{{$question->question}}</td>
                                    <td>{{$question['quiz']->title}}</td>
{{--                                    <td><span class="@if($question->option_one ==$question->answer) text-success @endif">{{$question->option_one}}</span></td>--}}
                                    <td><span class="@if(1 ==$question->answer) text-success @endif">{{$question->option_one}}</span></td>
                                    <td><span class="@if(2 ==$question->answer) text-success @endif">{{$question->option_two}}</span></td>
                                    <td><span class="@if(3 ==$question->answer) text-success @endif">{{$question->option_three}}</span></td>
                                    <td><span class="@if(4 ==$question->answer) text-success @endif">{{$question->option_four}}</span></td>

                                    <td>
                                        <a href="{{route('admin.edit.question',lock($question->id))}}"
                                           data-toggle="tooltip" title="Edit" class="btn btn-warning btn-sm"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="{{route('admin.delete.question',lock($question->id))}}" onclick="return confirm('Are you sure want to delete this?')" data-toggle="tooltip" title="Delete"
                                           class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="8"><span
                                        class="fa fa-ban text-danger"> Empty</span></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    {{$questions->links()}}
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@stop

