@extends('admin.layouts.app')
@section('title','User Details')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-7">
                <div class="card">
                    @if($user->avatar)
                        <img src="{{asset($user->avatar)}}" class="mt-2 card-img-top rounded-circle mx-auto d-block" style="height: 130px; width: 130px; object-fit: cover; object-position: top" alt="...">
                    @else
                        <img src="{{asset("admin/images/users/pp.png")}}" class="mt-2 card-img-top rounded-circle mx-auto d-block" style="height: 130px; width: 130px; object-fit: cover; object-position: top" alt="...">
                    @endif
                    <div class="card-body text-center">
                        <h5>{{$user->name}}</h5>
                        <p style="font-size: 14px"><b>Mother Name:</b> &nbsp; {{$user->mother_name}}</p>
                        <p style="font-size: 14px"><b>Father Name:</b> &nbsp; {{$user->father_name}}</p>
                        <p style="font-size: 14px"><b>Email:</b> &nbsp; {{$user->email}}</p>
                        <p style="font-size: 14px"><b>Mobile:</b> &nbsp; {{$user->mobile}}</p>
                        <p style="font-size: 14px"><b>Address:</b> &nbsp; {{$user->address}}</p>
                        <p style="font-size: 14px"><b>Facebook:</b> &nbsp; {{$user->facebook}}</p>
                        <a href="{{ URL::previous() }}" class="btn btn-warning btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
{{--                        <a href="{{route('admin.user.edit',lock($user->id))}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> Edit</a>--}}
                    </div>

                </div>
            </div>
        </div>
    </div>

@stop
