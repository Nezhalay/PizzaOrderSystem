@extends('admin.layout.master2')

@section('title','category list page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-5 offset-6">
                        @if (session('UpdateSuccess'))
                            <div class="">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation me-2"></i> {{session('UpdateSuccess')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            @endif
                    </div>
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            {{-- <div class="card-title">
                                <h3 class="text-center title-2">Pizza Details</h3>
                            </div>  <hr> --}}

                            {{-- back click --}}
                            <div class="ms-2">
                                <a href="{{route('product#list')}}">
                                    <i class=" text-black fa-solid fa-angles-left"></i>
                                </a>
                            </div>

                            <div class="row mt-4">
                                <div class="col-3 offset-1">
                                    <div class="image">
                                            <img src="{{asset('storage/'.$pizza->image)}}" />
                                    </div>
                                </div>
                                <div class="col-7 ">
                                    <div class="my-3 btn btn-danger d-block w-50">{{$pizza->name}}</div>
                                    <span class="my-3 btn bg-black text-white"> <i class="fa-solid fa-comment-dollar me-2 fs-4"></i>{{$pizza->price}}</span>
                                    <span class="my-3 btn bg-black text-white"> <i class="fa-solid fa-hourglass-half me-2 fs-4"></i>{{$pizza->waiting_time}}</span>
                                    <span class="my-3 btn bg-black text-white"> <i class="fa-solid fa-eye me-2 fs-4"></i>{{$pizza->view_count}} </span>
                                    <span class="my-3 btn bg-black text-white"> <i class="fa-solid fa-clone me-2 fs-4"></i>{{$pizza->category_name}}</span>
                                    <span class="my-3 btn bg-black text-white"> <i class="fa-solid fa-user-clock me-2 fs-4"></i>{{$pizza->created_at->format('j-F-Y')}}</span>
                                    <span class="my-3 btn bg-black d-block w-25 text-white"><i class="fa-solid fa-clipboard me-2 fs-4"></i>Details</span>
                                    <div class="">
                                        {{$pizza->description}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

