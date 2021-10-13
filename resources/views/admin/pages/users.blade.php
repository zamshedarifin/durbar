@extends('admin.layouts.app')
@section('title','List of User')
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
                <h5 class="mt-0 font-14 mb-3 text-uppercase">List of User</h5>
                <div class="table-responsive">
                    <table
                        class="table table-hover table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center">S.L</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Joined</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(@count($users)>0)
                            @foreach($users as $key=>$user)
                                <tr>
                                    <td class="text-center">{{$users->firstItem()+$key}}.</td>
                                    <td>{{$user->name}}</td>
                                    <td><a href="mailto: {{$user->email}}"><i class="fa fa-envelope"></i> {{$user->email}}</a></td>
                                    <td>{{$user->created_at->diffForHumans()}}</td>
                                    <td class="text-center">
                                        <a href="#"
                                           data-toggle="tooltip" title="Send Message"
                                           class="btn btn-sm btn-success"><i class="fa fa-paper-plane"></i></a>
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
                    {{$users->links()}}
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@stop

