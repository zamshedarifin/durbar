@extends('admin.layouts.app')
@section('title','Union')


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
                <h5 class="mt-0 font-18 text-center mb-3 text-uppercase">List of Union<br>
                    Total: {{$unions->total()}}</h5>
                <form action="{{route('admin.union.ward')}}" method="GET " class="form-row">
                    <div class="form-group col-md-3">
                        <select name="district" id="district" class="form-control">
                            <option value="" selected disabled>Choose District</option>
                            @if($districts)
                                @foreach($districts as $district)
                                    <option value="{{$district->id}}" {{$district->id == request('district')?'selected':''}}>{{$district->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <select name="upazila" id="upazila" class="form-control">
                            <option value="" selected disabled>Choose Upazila</option>
                            @if($upazilas)
                                @foreach($upazilas as $upazila)
                                    <option value="{{$upazila->id}}" {{$upazila->id == request('upazila')?'selected':''}}>{{$upazila->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-4">
                        <button class="btn btn-primary"><i class="fa fa-filter"></i> Filter</button>
                        <a href="{{route('admin.create.union')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add
                            Union/Ward</a>
                    </div>
                </form>

                <div class="table-responsive-md table-responsive-sm table-responsive-xl table-responsive-lg">
                    <table
                        class="table table-hover table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center">S.L</th>
                            <th>Name[ENG]</th>
                            <th>Name[বাংলা]</th>
                            <th>Upazila</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(@count($unions)>0)
                            @foreach($unions as $key=>$union)
                                <tr>
                                    <td class="text-center">{{$unions->firstItem()+$key}}.</td>
                                    <td>{{$union->name}}</td>
                                    <td>{{$union->bn_name}}</td>
                                    <td>{{$union['upazila']->bn_name}}</td>

                                    <td class="text-center tbl_btn">

                                        <div class="side">
                                            <a href="#" data-toggle="tooltip" title="Edit"
                                               class="btn btn-sm btn-primary"><i
                                                    class="fa fa-edit"></i></a>
                                            <a href="{{route('admin.delete.union',lock($union->id))}}"
                                               onclick="return confirm('Are you sure want to delete this?')"
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
                    {{$unions->links()}}
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

@section('script')
    <script type="text/javascript">
        $('#district').change(function () {
            var districtId = $(this).val();
            if (districtId) {
                $.ajax({
                    type: "GET",
                    url: "https://durbar21.org/upazila/" + districtId,
                    success: function (res) {
                        if (res) {
                            $("#upazila").empty();
                            $("#upazila").append('<option disabled selected>Choose Upazila</option>');
                            $.each(res, function (key, value) {
                                $("#upazila").append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        } else {
                            $("#upazila").empty();
                        }
                    }
                });
            } else {
                $("#upazila").empty();
            }
        });

    </script>
@stop
