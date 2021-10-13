@extends('admin.layouts.app')
@section('title','Feedback')


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
                @elseif($message = Session::get('error'))
                    <div class="alert alert-icon alert-danger text-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="mdi mdi-check-all mr-2"></i>
                        <strong>Success!</strong> {{$message}}
                    </div>

                @endif
                <h5 class="mt-0 font-18 text-center mb-3 text-uppercase">Feedbacks<br>
                    Total: {{$feedbacks->total()}}</h5>
                <div class="table-responsive-md table-responsive-sm table-responsive-xl table-responsive-lg">
                    <table
                        class="table table-hover table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center">S.L</th>
                            <th>Name</th>
{{--                            <th>Email</th>--}}
                            <th width="60%">Message</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(@count($feedbacks)>0)
                            @foreach($feedbacks as $key=>$feedback)
                                <tr>
                                    <td class="text-center">{{$feedbacks->firstItem()+$key}}.</td>
                                    <td>{{$feedback->name}}</td>
                                   {{-- <td><a href="mailto: {{$feedback->email}}"><i
                                                class="fa fa-envelope"></i> {{$feedback->email}}</a></td>--}}
{{--                                    <td>{!!  wordwrap($feedback->message,100,'<br>')!!}</td>--}}
                                    <td>{{description_shortener($feedback->message,100)}}</td>
                                    <td class="text-center" >
                                        <a href="{{route('admin.feedback.reply',lock($feedback->id))}}" class="btn btn-sm btn-primary"><i class="fa fa-envelope"></i></a>
                                        <a href="{{route('admin.feedback.show',lock($feedback->id))}}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                        <a href="{{route('admin.feedback.destroy',lock($feedback->id))}}" data-toggle="tooltip" title="delete"
                                           onclick="return alert('are you want to sure delete this feedback?')"
                                           class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="5"><span
                                        class="fa fa-ban text-danger"> Empty</span></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{$feedbacks->links()}}
                    </div>

                </div>
            </div>
        </div>

        <!-- end row -->
    </div>
@stop

@section('css')

@stop
