@extends('admin.layout.master2')

@section('title','category list page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    {{-- <div class="col-3 offset-8">
                        <a href="{{route('category#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div> --}}
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
                            <div class="ms-2">
                                <a href="{{route('product#list')}}">
                                    <i class=" text-black fa-solid fa-angles-left"></i>
                                </a>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Info</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-3 offset-2">
                                    <div class="image">
                                        @if (Auth::user()->image == null )
                                           @if (Auth::user()->gender == 'male')
                                                <img src="{{asset('image/male.jpg')}}" class="img-thumbnail">
                                           @else
                                                <img src="{{asset('image/female.jpg')}}" class="img-thumbnail">
                                           @endif
                                        @else
                                            <img src="{{asset('storage/'.Auth::user()->image)}}" />
                                        @endif

                                    </div>
                                </div>
                                <div class="col-5 offset-1">
                                    <h4 class="my-3"> <i class="fa-solid fa-user-pen me-3"></i>{{Auth::user()->name}}</h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-envelope me-3"></i>{{Auth::user()->email}}</h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-square-phone-flip me-3"></i>{{Auth::user()->phone}}</h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-venus-mars me-3"></i>{{Auth::user()->gender}} </h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-address-card me-3"></i>{{Auth::user()->address}}</h4>
                                    <h4 class="my-3"> <i class="fa-solid fa-user-clock me-3"></i>{{Auth::user()->created_at->format('j-F-Y')}}</h4>
                                </div>
                            </div>
                            <div class="row">
                                <a href="{{route('admin#edit')}}">
                                    <div class="col-3 offset-2 mt-2">
                                        <button class="btn bg-dark text-white"><i class="fa-solid fa-pen-to-square me-2"></i>Edit Profile</button>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

