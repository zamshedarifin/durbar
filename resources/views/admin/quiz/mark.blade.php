@extends('admin.layouts.app')
@section('title','Mark')

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
                <h5 class="mt-0 text-center">{{$data['quiz']->title}}
{{--                        <br> Total: {{$data['marks']->total()}}</h5>--}}
                    <br> Total: {{$data['count']}}</h5>

{{--                    <form action="{{route('admin.quiz.mark',lock($data['quiz']->id))}}" method="GET" class="form-row">--}}
{{--                        <div class="form-group col-md-4">--}}
{{--                            <input type="text" value="{{request('name')}}" autocomplete="off" placeholder="Search by name" class="form-control" name="name">--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-md-3">--}}
{{--                            <input type="email" value="{{request('email')}}" autocomplete="off" placeholder="Search by email" class="form-control" name="email">--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-md-3">--}}
{{--                            <input type="tel" value="{{request('mobile')}}" autocomplete="off" placeholder="Search by mobile" class="form-control" name="mobile">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-2">--}}
{{--                            <button class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}

                <div class="table-responsive">


                    <table id="example"
                        class="table table-hover mails m-0 table table-actions-bar table-centered table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center">S.L</th>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Marks</th>
                            <th>Time</th>
                            <th>status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php
                            $i=1;
                        @endphp
                        @forelse($data['marks'] as $k=>$marks)

                            @if($marks->user->is_ban == 0 && $marks->mark != 0)
                                @php
                                    $time=(($marks->seconds) / 60)
                                @endphp
                                <tr>
                                    <td class="text-center"><b>{{$i++}}</b>.</td>
                                    <td>
                                        @if($marks->user->avatar)
                                            <img src="{{asset($marks->user->avatar)}}" style="height: 40px; width:40px">
                                        @else
                                            <img src="{{asset("admin/images/users/pp.png")}}" style="height: 40px; width:40px">
                                        @endif
                                    </td>
                                    <td>{{$marks->user->name}}</td>
                                    <td><a href="mailto: {{$marks->user->email}}"><i class="fa fa-envelope"></i> {{$marks->user->email}}</a></td>

                                    <td>{{$marks->user->mobile}}</td>
                                    <td>{{$marks->mark}}</td>
                                    <td> @if($marks->seconds > 59)
                                            {{round($time,2).' '.'Min'}}
                                        @else
                                            {{$marks->seconds.' '.'Sec'}}
                                        @endif
                                    </td>
                                    <td>
                                        @if($marks->user->is_ban == 1)
                                            <span class="btn btn-danger btn-sm">Ban</span>
                                        @else
                                            <span class="btn btn-success btn-sm">Active</span>
                                        @endif
                                    </td>

                                    <td> <a href="{{route('admin.user.info',lock($marks->user->id))}}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>

                                        <a href="{{route('admin.ban.user',lock($marks->user->id))}}" class="btn btn-dark btn-sm" data-toggle="tooltip" title="Ban User" onclick="return confirm('Ban this user permanently?')"><i class="fa fa-times"></i></a>
                                        <a href="{{route('admin.marksheet.delete',lock($marks->id))}}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete User" onclick="return confirm('Delete this user from mark table?')"><i class="fa fa-trash"></i></a>
                                    </td>

                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td class="text-center" colspan="8"><span
                                        class="fa fa-ban text-danger"> Empty</span></td>
                            </tr>

                        @endforelse
                        </tbody>
                    </table>
                    <br>
                     <div class="d-flex justify-content-center">
{{--                        {{$data['marks']->links()}}--}}
                    </div>

                </div>
                <div class="text-center mt-2 d-flex justify-content-center">

                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
@stop

@push('js')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );

        $('#example').dataTable( {
            "lengthMenu": [50,100,200,500 ]
        } );


    </script>
@endpush

