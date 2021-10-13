@extends('admin.layouts.app')
@section('title','List of Campaigns')

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
                    <h5 class="mt-0 font-18 mb-3 text-center">List of Campaigns<br>
                    Total: {{$campaigns->total()}}</h5>

                    <form action="" class="form-row">
                        <div class="form-group col-md-4">
                            <input type="text" value="{{request('title')}}" autocomplete="off" placeholder="Search by title" class="form-control" name="title">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="text" value="{{request('date')}}" autocomplete="off" placeholder="Search by date" class="form-control datepicker" name="date">
                        </div>
                        <div class="form-group col-md-2">
                            <select name="status" id="status" class="form-control ">
                                <option value="" selected="" disabled="">Status</option>
                                <option value="0" {{request('status')=='0'?'selected':''}}>Pending</option>
                                <option value="1" {{request('status')=='1'?'selected':''}}>Ongoing</option>
                                <option value="4" {{request('status')=='4'?'selected':''}}>Previous</option>
                                <option value="2" {{request('status')=='2'?'selected':''}}>Closed</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                            <a href="{{route('admin.create.campaign')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table
                            class="table table-hover mails m-0 table table-actions-bar table-centered table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-center">S.L</th>
                                <th>Cover</th>
                                <th>Title</th>
                                <th width="30%">Short Description</th>
                                {{--                                <th>Date</th>--}}
                                <th width="12%">Status</th>
                                <th width="19%">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if(@count($campaigns)>0)
                                @foreach($campaigns as $key=>$campaign)
                                    <tr>
                                        <td class="text-center"><b>{{$campaigns->firstItem()+$key}}</b>.</td>
                                        <td>
                                            <img src="{{asset("uploads/campaign/$campaign->cover")}}" style="height: 70px;width: 200px;object-fit: contain" class="img-thumbnail" alt="">
                                        </td>
                                        <td>{{$campaign->title}}</td>
                                        <td>{{$campaign->short_desc}}</td>
                                        {{--                                        <td>{{$campaign->cam_date}}</td>--}}
                                        <td>
                                            @if($campaign->status == 1)
                                                <span class="fa fa-check-circle text-success"> Ongoing</span>
                                            @elseif($campaign->status == 2)
                                                <span class="fa fa-times-circle text-danger"> Closed</span>
                                            @elseif($campaign->status == 3)
                                                <span class="fa fa-calendar-check text-info"> Upcoming</span>
                                            @elseif($campaign->status == 4)
                                                <span class="fa fa-calendar-check text-dark"> Previous</span>
                                                @else
                                                <span class="fa fa-clock text-primary"> Pending</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{route('admin.campaign.enroll',lock($campaign->id))}}" data-toggle="tooltip" title="Enrolls" class="btn btn-info btn-sm"><i class="fa fa-list-ul"></i></a>
                                            <a href="{{route('admin.add.story',lock($campaign->id))}}" data-toggle="tooltip" title="Add Story" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i></a>
                                            <a href="{{route('admin.edit.campaign',lock($campaign->id))}}" data-toggle="tooltip" title="Edit Campaign" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="#" data-toggle="tooltip" title="Delete Campaign" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
                    </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@stop

