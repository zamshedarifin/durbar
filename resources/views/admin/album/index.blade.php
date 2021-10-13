@extends('admin.layouts.app')

@section('title') Manage albums @endsection
@section('css')
    <style>
        .img-custom{
            height: 70px;
            width: 150px;
            object-fit: cover;
            object-position: center center;
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- start  -->
        <div class="row">
            <div class="col-12">
                <div>
                    <h4 class="header-title mb-3 text-uppercase">List of Album</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0 table-bordered">
                                <thead class="thead-light">
                                <tr>
                                    <th class="text-center">S.L</th>
                                    <th>Album Cover</th>
                                    <th>Title</th>
                                    <th>Created</th>
                                    <th>Status</th>
                                    <th width="22%" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(@count($albums)>0)
                                    @foreach($albums as $key=>$album)
                                        <tr>
                                            <th class="text-center" scope="row" style="vertical-align: middle">{{$key+$albums->firstItem()}}.</th>
                                            <td class="text-center" style="vertical-align: middle">
                                                <img src="{{asset("uploads/album/$album->thumbnail")}}" alt="dsa" class="img-custom img-thumbnail">
                                            </td>
                                            <td style="vertical-align: middle">{{$album->title}}</td>
                                            <td style="vertical-align: middle"><span class="badge badge-success">{{$album->created_at->diffForHumans()}}</span></td>
                                            <td style="vertical-align: middle">
                                                @if($album->status == 1)
                                                    <span class="fas fa-check-circle text-success"> Active</span>
                                                @else
                                                    <span class="fas fa-times-circle text-danger"> Inactive</span>
                                                @endif
                                            </td>
                                            <td style="vertical-align: middle" class="text-center">
                                                <a href="{{route('admin.album.show',lock($album->id))}}" data-toggle="tooltip" data-placement="top" title="View Album Photos" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('admin.album.photo-add',lock($album->id))}}" data-toggle="tooltip" data-placement="top" title="Add Photo" class="btn btn-dark btn-sm"><i class="fa fa-plus"></i></a>
                                                <a href="{{route('admin.album.edit',lock($album->id))}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                                <a href="{{route('admin.album.delete',lock($album->id))}}" onclick="return confirm('Are you sure want to delete this?')" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center text-danger"><i class="fa fa-ban"></i> Empty</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                            {{$albums->links()}}
                        </div>
                    </div>

                </div>
            </div><!-- end col -->
        </div>
    </div>

    <!-- end row -->

@endsection

@section('script')

@endsection




