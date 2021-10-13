@extends('admin.layouts.app')
@section('title','List of User')
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
                <h5 class="mt-0 font-18 text-center mb-3 text-uppercase">List of User<br>
                    Total: {{$users->total()}}</h5>
                <form action="{{route('admin.user.list')}}" method="GET " class="form-row">
                    <div class="form-group col-md-2">
                        <input type="text" value="{{request('name')}}" autocomplete="off" placeholder="Search by name"
                               class="form-control" name="name">
                    </div>

                    <div class="form-group col-md-3">
                        <input type="email" value="{{request('email')}}" autocomplete="off"
                               placeholder="Search by email" class="form-control" name="email">
                    </div>

                    <div class="form-group col-md-2">
                        <select name="verify" id="verify" class="form-control ">
                            <option value="" selected="" disabled="">Verify Status</option>
                            <option value="1" {{request('verify')=='1'?'selected':''}}>Verified</option>
                            <option value="0" {{request('verify')=='0'?'selected':''}}>Unverified</option>
                        </select>
                    </div>
                     <div class="form-group col-md-2">
                        <select name="ban" id="ban" class="form-control ">
                            <option value="" selected="" disabled="">Account Status</option>
                            <option value="1" {{request('ban')=='1'?'selected':''}}>Ban User</option>
                            <option value="0" {{request('ban')=='0'?'selected':''}}>Active User</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                        {{--<a href="#" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>--}}
                        <a href="{{route('admin.user.list')}}" data-toggle="tooltip" data-placement="top"
                           title="Refresh" class="btn btn-danger"><i class="fa fa-sync"></i></a>
                    </div>
                </form>
                <div class="table-responsive-md table-responsive-sm table-responsive-xl table-responsive-lg">
                    <table
                        class="table table-hover table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center">S.L</th>
                            <th>
                                @if(request('n_ord')=='desc')
                                    <a class="text-dark" href="{{route('admin.user.list')}}?n_ord=asc&name={{request('name')}}&email={{request('name')}}&verify={{request('verify')}}&page={{request('page')}}"><i class="fas fa-sort-down"></i> Name</a>
                                @elseif(request('n_ord')=='asc')
                                    <a class="text-dark" href="{{route('admin.user.list')}}?n_ord=desc&name={{request('name')}}&email={{request('name')}}&verify={{request('verify')}}&page={{request('page')}}"><i class="fas fa-sort-up"></i> Name</a>
                                @else
                                    <a class="text-dark" href="{{route('admin.user.list')}}?n_ord=asc&name={{request('name')}}&email={{request('name')}}&verify={{request('verify')}}&page={{request('page')}}"><i class="fas fa-sort"></i> Name</a>
                                @endif
                            </th>
                            <th>
                                @if(request('e_ord')=='desc')
                                    <a class="text-dark" href="{{route('admin.user.list')}}?e_ord=asc&name={{request('name')}}&email={{request('name')}}&verify={{request('verify')}}&page={{request('page')}}"><i class="fas fa-sort-down"></i> Email</a>
                                @elseif(request('e_ord')=='asc')
                                    <a class="text-dark" href="{{route('admin.user.list')}}?e_ord=desc&name={{request('name')}}&email={{request('name')}}&verify={{request('verify')}}&page={{request('page')}}"><i class="fas fa-sort-up"></i> Email</a>
                                @else
                                    <a class="text-dark" href="{{route('admin.user.list')}}?e_ord=asc&name={{request('name')}}&email={{request('name')}}&verify={{request('verify')}}&page={{request('page')}}"><i class="fas fa-sort"></i> Email</a>
                                @endif
                            </th>
                            {{--                            <th>Joined</th>--}}
                            <th>Account Status</th>
                            <th>Verified</th>
                            <th>Role</th>
                            {{--                            <th>Active</th>--}}
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(@count($users)>0)
                            @foreach($users as $key=>$user)
                                <tr>
                                    <td class="text-center">{{$users->firstItem()+$key}}.</td>
                                    <td>{{$user->name}}</td>
                                    <td><a href="mailto: {{$user->email}}"><i
                                                class="fa fa-envelope"></i> {{$user->email}}</a></td>
                                    {{--                                    <td>{{$user->created_at->diffForHumans()}}</td>--}}
                                    <td>
                                        @if($user->is_ban == 1)
                                        <span  class="fa fa-user-times text-danger"> Banned</span>
                                        @else
                                        <span class="fa fa-user-circle text-success"> Active</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($user->email_verified_at)
                                            <span class="fa fa-check-circle text-success"> Verified</span>
                                        @endif
                                    </td>

                                    <td>
                                        <span class="badge badge-primary">Member</span>
                                    </td>
                                    {{--<td>
                                        @if($user->is_active==1)
                                            <span class="fa fa-check text-success"> Active</span>
                                        @else
                                            <span class="fa fa-times text-danger"> Inactive</span>
                                        @endif
                                    </td>--}}
                                    <td class="text-center tbl_btn">
                                        <div class="side">
                                            @if($user->is_active == 0)
                                                <a href="{{route('admin.user.status',[lock($user->id),lock(1)])}}"
                                                   data-toggle="tooltip" title="Activate this Account"
                                                   class="btn btn-sm btn-success"><i class="fa fa-thumbs-up"></i></a>
                                            @else
                                                <a href="{{route('admin.user.status',[lock($user->id),lock(0)])}}"
                                                   data-toggle="tooltip" title="Deactivate/Banned this Account"
                                                   class="btn btn-sm btn-danger"><i class="fa fa-thumbs-down"></i></a>
                                            @endif

                                            <a href="{{route('admin.user.info',lock($user->id))}}" data-toggle="tooltip"
                                               title="View Details"
                                               class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                                        </div>
                                        <div class="side">
                                            <a href="{{route('admin.user.edit',lock($user->id))}}" data-toggle="tooltip"
                                               title="Edit" class="btn btn-sm btn-primary"><i
                                                    class="fa fa-edit"></i></a>
                                            <a href="{{route('admin.user.delete',lock($user->id))}}"
                                               onclick="return confirm('Are you sure want to delete this user?')"
                                               data-toggle="tooltip" title="Delete"
                                               class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </div>

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
                        {{$users->links()}}
                    </div>

                </div>
            </div>
        </div>
        <style>
            .tbl_btn .side {
                display: inline-block;
            }

            @media only screen and (min-width: 1193px) and (max-width: 1313px) {
                .table td {
                    padding: 0;
                }
            }

            @media only screen and (min-width: 1127px) and (max-width: 1192px) {
                .side:last-child {
                    margin-top: 2px;
                }
            }

            @media only screen and (min-width: 1025px) and (max-width: 1127px) {
                td.text-center.tbl_btn {
                    padding: 0;
                }

                .side:last-child {
                    margin-top: 2px;
                }
            }

            @media only screen and (min-width: 938px) and (max-width: 1024px) {
                .side:last-child {
                    margin-top: 2px;
                }

                .table {
                    overflow-x: scroll;
                }
            }

            @media only screen and (min-width: 618px) and (max-width: 938px) {
                td.text-center.tbl_btn {
                    padding: 0;
                }

                .side:last-child {
                    margin-top: 2px;
                }
            }

        </style>
        <!-- end row -->
    </div>
@stop

@section('css')

@stop
