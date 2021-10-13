@extends('admin.layouts.app')
@section('title','Campaign Stories')

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
                    <h5 class="mt-0 font-14 mb-3">List of Campaign Stories</h5>
                    <div class="table-responsive">
                        <table
                            class="table table-hover mails m-0 table table-actions-bar table-centered table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">S.L</th>
                                <th>Cover</th>
                                <th>Title</th>
                                <th width="30%">Description</th>
                                <th>Campaign</th>
                                {{--                                <th>Date</th>--}}
                                <th width="12%">Status</th>
                                <th width="12%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(@count($stories)>0)
                                @foreach($stories as $key=>$story)
                                    <tr>
                                        <td class="text-center"><b>{{$stories->firstItem()+$key}}</b>.</td>
                                        <td>
                                            <img src="{{asset("uploads/story/$story->cover")}}" style="height: 70px;width: 200px;object-fit: contain" class="img-thumbnail" alt="">
                                        </td>
                                        <td>{{$story->title}}</td>
                                        <td>{!!Illuminate\Support\Str::limit(strip_tags($story->description),350) !!}</td>
                                        <td>{{$story['campaign']->title}}</td>
                                        {{--                                        <td>{{$campaign->cam_date}}</td>--}}
                                        <td>
                                            @if($story->status == 1)
                                                <span class="fa fa-check-circle text-success"> Active</span>
                                            @elseif($story->status == 0)
                                                <span class="fa fa-times-circle text-danger"> Inactive</span>
                                            @endif
                                        </td>

                                        <td>
                                             <a href="{{route('admin.edit.story',lock($story->id))}}" data-toggle="tooltip" title="Edit Story" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                            <a href="#" onclick="return confirm('Are you sure want to delete this?')" data-toggle="tooltip" title="Delete Story" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="7"><span
                                            class="fa fa-ban text-danger"> Empty</span></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{$stories->links()}}
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@stop
