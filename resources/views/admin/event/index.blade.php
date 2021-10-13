@extends('admin.layouts.app')
@section('title','Manage Event')
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
                <h5 class="mt-0 font-14 mb-3 text-uppercase">List of Events</h5>
                <div class="table-responsive-md table-responsive-sm table-responsive-lg table-responsive-xl">
                    <table
                        class="table table-hover  mails m-0 table table-actions-bar table-centered">
                        <thead>
                        <tr>
                            <th class="text-center">S.L</th>
                            <th>Cover</th>
                            <th>Title</th>
                            <th width="25%">Location</th>
                            <th width="14%" class="text-center">Event Date</th>
                            <th width="11%" class="text-center">Status</th>
                            <th width="25%" class="text-center">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(@count($events)>0)
                            @foreach($events as $key=>$event)
                                <tr>
                                    <td class="text-center"><b>{{$events->firstItem()+$key}}</b>.</td>
                                    <td>
                                        <img src="{{asset("uploads/event/$event->cover")}}"
                                             style="height: 70px;width: 200px;object-fit: contain" class="img-thumbnail"
                                             alt="">
                                    </td>
                                    <td>{{$event->title}}</td>
                                    <td>{{$event->location}}</td>
                                    <td class="text-center"><i class="fa fa-calendar"></i> {{date('d-m-Y',strtotime($event->event_date))}}
                                    </td>
                                    {{--                                        <td>{{$campaign->cam_date}}</td>--}}
                                    <td class="text-center">
                                        @if($event->status == 1)
                                            <span class="fa fa-check-circle text-success"> Active</span>
                                        @else
                                            <span class="fa fa-times-circle text-danger"> Inactive</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        @if($event->status == 1)
                                            <a href="" data-toggle="tooltip" title="Inactive"
                                               class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i></a>
                                        @else
                                            <a href="#" data-toggle="tooltip" title="Active"
                                               class="btn btn-success btn-sm"><i class="fa fa-thumbs-up"></i></a>
                                        @endif
                                        <a href="{{route('admin.edit.event',lock($event->id))}}" data-toggle="tooltip"
                                           title="Edit" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                        <a href="#" data-toggle="tooltip" title="Delete"
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
                    {{$events->links()}}
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@stop

