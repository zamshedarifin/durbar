@extends('admin.layouts.app')
@section('title','Dashboard')
@section('content')
    <style>
        .shadow-sm {
            box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div>
                    <h4 class="header-title mb-3">ডিজিটাল বাংলাদেশে আমরা দুর্বার</h4>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-12">
                <div>
                    <div class="card-box widget-inline shadow-sm border-0">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6 widget-inline-box">
                                <div class="text-center p-3">
                                    <h2 class="mt-2"><i class="text-primary fa fa-list mr-2"></i> <b>{{number_format($data['ambassadors'])}}</b></h2>
                                    <p class="text-muted mb-0">Total Ambassadors Application</p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6 widget-inline-box">
                                <div class="text-center p-3">
                                    <h2 class="mt-2"><i class="text-warning fa fa-calendar-check mr-2"></i> <b>{{number_format($data['todayApp'])}}</b></h2>
                                    <p class="text-muted mb-0">Today Ambassadors Application</p>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 widget-inline-box">
                                <div class="text-center p-3">
                                    <h2 class="mt-2"><i class="text-teal fa fa-users mr-2"></i> <b>{{number_format($data['users'])}}</b></h2>
                                    <p class="text-muted mb-0">Total Users</p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-sm-6">
                                <div class="text-center p-3">
                                    <h2 class="mt-2"><i class="text-success fa fa-check-circle mr-2"></i> <b>{{number_format($data['verified'])}}</b></h2>
                                    <p class="text-muted mb-0">Verified Users</p>
                                </div>
                            </div>

                           {{-- <div class="col-xl-3 col-sm-6 widget-inline-box">
                                <div class="text-center p-3">
                                    <h2 class="mt-2"><i class="text-info mdi mdi-black-mesa mr-2"></i> <b>6521</b></h2>
                                    <p class="text-muted mb-0">Total users</p>
                                </div>
                            </div>

                            <div class="col-xl-3 col-sm-6">
                                <div class="text-center p-3">
                                    <h2 class="mt-2"><i class="text-danger mdi mdi-cellphone-link mr-2"></i> <b>325</b></h2>
                                    <p class="text-muted mb-0">Total visits</p>
                                </div>
                            </div>--}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h5>Ambassadors</h5>
                <div class="table-responsive">
                    <table
                        class="table table-hover table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center">S.L</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Age</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(@count($ambassadors)>0)
                            @foreach($ambassadors as $key=>$ambassador)
                                <tr>
                                    <td class="text-center">{{$key+1}}.</td>
                                    <td>
                                        @if($ambassador->is_sent == 1)
                                            <i class="fa fa-check-circle text-success"></i>
                                        @endif

                                        {{$ambassador->name}}
                                    </td>
                                    <td>{{$ambassador->email}}</td>
                                    <td>0{{$ambassador->cell_phone}}</td>
                                    <td>{{$ambassador->age}}</td>
                                    <td>
                                        @if($ambassador->status == 0)
                                            <span class="fa fa-clock text-primary"> Pending</span>
                                        @elseif($ambassador->status == 1)
                                            <span class="fa fa-check-circle text-success"> Approved</span>
                                        @elseif($ambassador->status == 2)
                                            <span class="fa fa-times-circle text-danger"> Reject</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($ambassador->status == 1)
                                            <a href="{{route('admin.ambassador.status',[lock(2),lock($ambassador->id)])}}"
                                               onclick="return confirm('Are you sure want to reject this?')"
                                               data-toggle="tooltip" title="Reject" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-thumbs-down"></i></a>
                                        @else
                                            <a href="{{route('admin.ambassador.status',[lock(1),lock($ambassador->id)])}}"
                                               onclick="return confirm('Are you sure want to approve this?')"
                                               data-toggle="tooltip" title="Approve" class="btn btn-success btn-sm"><i
                                                    class="fa fa-thumbs-up"></i></a>
                                        @endif
                                        <a href="{{route('admin.ambassador.show',lock($ambassador->id))}}"
                                           data-toggle="tooltip" title="View Application"
                                           class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
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
            </div>
        </div>

    </div>
@stop
