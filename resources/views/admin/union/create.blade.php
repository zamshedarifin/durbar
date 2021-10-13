@extends('admin.layouts.app')
@section('title','Create Union/Ward')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-5">
                <div class="card" id="top">
                    <div class="card-body">
                        <div class="alert alert-danger" style="display:none">
                            <ul id="errors"></ul>
                        </div>
                        <div class="alert alert-success alert-dismissible fade show" style="display: none"
                             role="alert">
                            <strong><i class="fa fa-check-circle"></i> Thank You!</strong> Union/ward has been added.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <h5 class="mt-0 font-18 text-center mb-3 text-uppercase">Add Union/Ward</h5>
                        <hr>

                        <form method="post" action="#" id="unionForm">@csrf
                            <div class="form-group">
                                <label for="">District*</label>
                                <select name="district" id="district"
                                        class="form-control @error('district') is-invalid @enderror">
                                    <option value="" selected disabled>Choose...</option>
                                    @if($districts)
                                        @foreach($districts as $district)
                                            <option value="{{$district->id}}">{{$district->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('district')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="upazila">Upazila*</label>
                                <select name="upazila" id="upazila"
                                        class="form-control @error('upazila') is-invalid @enderror">
                                    <option value="" selected disabled>Choose</option>
                                </select>
                                @error('upazila')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Union/Ward* <span class="text-danger">ENG</span></label>
                                <input type="text" class="form-control @error('union') is-invalid @enderror"
                                       name="union">
                                @error('union')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Union/Ward* <span class="text-success">বাংলা</span></label>
                                <input type="text" class="form-control @error('bn_union') is-invalid @enderror"
                                       name="bn_union">
                                @error('bn_union')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>

                            <div class="col-12 d-flex justify-content-center">
                                <a href="{{route('admin.union.ward')}}" class="btn btn-primary btn-sm"><i
                                        class="fa fa-list"></i> Unions</a>&nbsp;
                                <button class="btn btn-sm btn-success" id="submit"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                                    $("#upazila").append('<option disabled selected>Choose...</option>');
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
                $("#submit").click(function (e) {
                    e.preventDefault(),
                        $.ajaxSetup({headers: {"X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")}}),
                        $.ajax({
                            url: "{{route('admin.create.union')}}",
                            type: "POST",
                            dataType: "JSON",
                            data: new FormData(document.getElementById("unionForm")),
                            processData: !1,
                            contentType: !1,
                            success: function (e) {
                                console.log(e);
                                if (e.errors) {
                                    $('#errors').empty();
                                    $('.alert-danger').show();
                                    $.each(e.message, function (index, value) {
                                        $('#errors').append('<li>' + value + '</li>');
                                    });
                                } else if (e.success) {
                                    $('#unionForm')[0].reset();
                                    $('.alert-danger').hide();
                                    $(".alert-success").show();
                                    setTimeout(function () {
                                        location.reload();
                                    }, 4000);
                                }
                            },
                            error: function (e, t, a) {
                                console.log(e);
                                alert("Sorry, the request can not be processed at this moment. Please try again later");
                                // location.reload();
                            }
                        })
                });
            </script>
@stop
