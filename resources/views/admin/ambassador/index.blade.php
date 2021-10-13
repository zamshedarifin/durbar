@extends('admin.layouts.app')
@section('title','Ambassadors')
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
                @elseif($message = Session::get('error'))
                    <div class="alert alert-icon alert-danger text-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <i class="mdi mdi-check-all mr-2"></i>
                        <strong>Success!</strong> {{$message}}
                    </div>
                @endif
                <h5 class="mt-0 font-18 mb-3 text-uppercase text-center">Ambassadors Application
                <br> Total: {{$ambassadors->total()}}</h5>
                    <form action="{{route('admin.ambassador.list')}}" method="GET" class="form-row">
                        <div class="form-group col-md-3">
                            <input type="text" value="{{request('name')}}" autocomplete="off" placeholder="Search by name" class="form-control" name="name">
                        </div>
                        <div class="form-group col-md-3">
                            <input type="email" value="{{request('email')}}" autocomplete="off" placeholder="Search by email" class="form-control" name="email">
                        </div>
                        <div class="form-group col-md-2">
                            <input type="tel" value="{{request('mobile')}}" autocomplete="off" placeholder="Search by mobile" class="form-control" name="mobile">
                        </div>
                        <div class="form-group col-md-2">
                            <select name="status" id="status" class="form-control ">
                                <option value="" selected="" disabled="">Status</option>
                                <option value="0" {{request('status')=='0'?'selected':''}}>Pending</option>
                                <option value="1" {{request('status')=='1'?'selected':''}}>Approved</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                        </div>
                    </form>
                <div class="table-responsive">
                    <form action="#" method="get">
                        @csrf
                            <button type="submit" class="btn btn-primary mb-2" name="action" value="save"><i class="fa fa-file-excel"></i> Export Selected</button>

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
                                    <td class="text-center">{{$ambassadors->firstItem()+$key}}.</td>
                                    <td>
                                        @if($ambassador->is_sent == 1)
                                                <i class="fa fa-check-circle text-success"></i>
                                            @endif

                                        {{$ambassador->name}}
                                    </td>
                                    <td>{{strtolower($ambassador->email)}}</td>
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

                    </form>
                    <div class="d-flex justify-content-center">
                        {{$ambassadors->links()}}
                    </div>

                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@stop

