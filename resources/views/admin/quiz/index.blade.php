@extends('admin.layouts.app')
@section('title','List of Quiz')

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
                    <h5 class="mt-0 font-14 mb-3">List of Quiz</h5>
                    <div class="table-responsive">
                        <table
                            class="table table-hover mails m-0 table table-actions-bar table-centered table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">S.L</th>
                                <th>Quiz Title</th>
                                <th>Quiz Time</th>
                                <th>Created at</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if(@count($quizzes)>0)
                                @foreach($quizzes as $key=>$quiz)
                                    <tr>
                                        <td class="text-center"><b>{{$quizzes->firstItem()+$key}}</b>.</td>
                                        <td>{{$quiz->title}}</td>
                                        <td>{{$quiz->qz_time}} Minutes</td>
                                        <td>{{$quiz->created_at->diffForHumans()}}</td>
                                        <td>
                                            @if($quiz->status == 1)
                                                <span class="fa fa-check-circle text-success"> Active</span>
                                            @elseif($quiz->status == 0)
                                                <span class="fa fa-times-circle text-danger"> Inactive</span>
                                            @else
                                                <span class="fa fa-times-circle text-warning"> upcoming</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($quiz->status == 1)
                                                <a href="#"
                                                   data-toggle="tooltip" title="Inactive"
                                                   class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i></a>
                                            @else
                                                <a href="#"
                                                   data-toggle="tooltip" title="Active"
                                                   class="btn btn-success btn-sm"><i class="fa fa-thumbs-up"></i></a>
                                            @endif
                                            <a href="{{route('admin.quiz.mark',lock($quiz->id))}}"
                                               data-toggle="tooltip" title="Mark"
                                               class="btn btn-dark btn-sm"><i class="fa fa-clipboard"></i></a>

                                            <a href="{{route('admin.edit.quiz',lock($quiz->id))}}"
                                               data-toggle="tooltip" title="Edit Quiz" class="btn btn-warning btn-sm"><i
                                                    class="fa fa-edit"></i></a>
                                            <a href="#" data-toggle="tooltip" title="Delete Quiz"
                                               class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="6"><span
                                            class="fa fa-ban text-danger"> Empty</span></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        {{$quizzes->links()}}
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@stop

