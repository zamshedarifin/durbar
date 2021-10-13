@extends('admin.layouts.app')
@section('title','Enrolls')

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
                <h5 class="mt-0 text-center">{{$campaign->title}}</h5>
                    <h5 class="font-16 text-center text-muted">Date : {{date('j F, Y',strtotime($campaign->cam_date))}}<br>
                        Total Enroll : {{$enrolls->total()}}</h5>
                <div class="table-responsive">
                    <table
                        class="table table-hover mails m-0 table table-actions-bar table-centered table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center">S.L</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Joined</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(@count($enrolls)>0)
                            @foreach($enrolls as $key=>$enroll)
                                <tr>
                                    <td class="text-center"><b>{{$enrolls->firstItem()+$key}}</b>.</td>
                                    <td>{{$enroll['user']->name}}</td>
                                    <td>{{$enroll['user']->email}}</td>
                                    <td>{{date('j F, Y',strtotime($enroll->created_at))}}</td>
                                    <td>{{$enroll->created_at->diffForHumans()}}</td>
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

                </div>
                <div class="text-center mt-2 d-flex justify-content-center">
                    {{$enrolls->links()}}
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@stop

