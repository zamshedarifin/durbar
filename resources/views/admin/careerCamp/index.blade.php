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
                <h5 class="mt-0 font-18 mb-3 text-uppercase text-center">ICT Career Camp Registration
                    <br> Total: {{$count}}</h5>

                <div class="table-responsive">
                    <form action="{{route('admin.select.export')}}" method="get">
                        @csrf
{{--                    <button class="btn btn-primary mb-3" type="submit">Export Selected</button>--}}
                        <button type="submit" class="btn btn-primary mb-2" name="action" value="save"><i class="fa fa-file-excel"></i> Export Selected</button>
                        <button type="submit" class="btn btn-dark mb-2" name="action" value ="mail"><i class="fa fa-envelope"></i> Mail Selected</button>


                    <table id="example" class="table table-striped table-bordered">
                        <thead class="thead-light">
                        <tr>
                            <th width="6%">
                                <input type="checkbox" id="select_all">&nbsp;All</th>
                            <th width="15%">Name</th>
                            <th width="15%">Email</th>
                            <th>Mobile</th>
                            <th>Age</th>
                            <th>Mark</th>
                            <th>Time</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(@count($careerCamps)>0)

                            @foreach($careerCamps as $key=>$careerCamp)
                             @if(!empty($careerCamp->name))
                                <?php
                                $time=(($careerCamp->seconds) / 60);
                                ?>

                                <tr>
                                    <td class="text-dark font-weight-bold">
                                        <input type="checkbox" name="studentId[]" class="checkbox" value="{{$careerCamp->id}}">  &nbsp;
                                    </td>
                                    <td class="text-dark font-weight-bold">
                                        {{$careerCamp->name}}
                                    </td>
                                    <td class="text-primary font-weight-bold">{{strtolower($careerCamp->email)}}</td>
                                    <td class="text-dark font-weight-bold">{{$careerCamp->cell_phone}}</td>
                                    <td class="text-warning font-weight-bold">{{$careerCamp->age}}</td>
                                    <td class="text-success font-weight-bold">{{$careerCamp->mark}}</td>
                                    <td class="text-danger font-weight-bold">
                                            @if($careerCamp->seconds > 59)
                                                সময়ঃ {{EnToBn(round($time,2).' '.'মিনিট')}}
                                            @else
                                            সময়ঃ {{EnToBn($careerCamp->seconds.' '. 'সেকেন্ড')}}
                                            @endif
                                    </td>

                                        <td>
                                            <a href="{{route('admin.careercamp.show',lock($careerCamp->id))}}"
                                               data-toggle="tooltip" title="View Application"
                                               class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>

                                            <a href="{{route('admin.send.mail',lock($careerCamp->id))}}"
                                               data-toggle="tooltip" title="Send Mail"
                                               class="btn btn-sm btn-primary"><i class="fa fa-envelope"></i></a>

                                            <a href="{{route('admin.careercamp.destroy',lock($careerCamp->id))}}"
                                               data-toggle="tooltip" title="Destroy User" onclick="return confirm('Are you sure want to delete this?')"
                                               class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>



                                    @endif
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
