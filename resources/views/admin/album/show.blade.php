@extends('admin.layouts.app')

@section('title'){{ucfirst($album->title)}} @endsection
@section('css')
    <style>

        .image {
            opacity: 1;
            display: block;
            width: 100%;
            transition: .5s ease;
            backface-visibility: hidden;
            height: 250px;
            object-fit: cover;
            object-position: top;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .card:hover .image {
            opacity: 0.3;
        }

        .card:hover .middle {
            opacity: 1;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center text-uppercase">{{ucfirst($album->title)}}</h4>
                    <hr>
                    <div class="row">
                        @if($album['photos'])
                            @foreach($album['photos'] as $photo)
                                <div class="col-md-4">
                                    <div class="card">
                                        <img class="card-img-top img-fluid img-custom image"
                                             src="{{asset("uploads/photo/$photo->photo")}}"
                                             alt="Card image cap">
                                        <div class="middle">
                                            <a href="{{route('admin.photo.delete',lock($photo->id))}}"
                                               onclick="return confirm('Are you sure want to delete this?')"
                                               class="btn btn-danger btn-sm btn-block"><i
                                                    class="fa fa-trash-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div>

@endsection

@section('script')

@endsection

