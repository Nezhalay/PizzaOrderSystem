@extends('user.layouts.master')

@section('title','user change password page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                {{-- <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{route('user#home')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div> --}}
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2"><i class="fa-solid fa-key me-2"></i>Change Password</h3>
                            </div>
                                @if (session('changeSuccess'))
                                <div class="col-12 ">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-circle-check me-2"></i>{{session('changeSuccess')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                                @endif
                                @if (session('notMatch'))
                                <div class="col-12 ">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-triangle-exclamation me-2"></i> {{session('notMatch')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                                @endif
                            <hr>
                            <form action="{{route('user#changePassword')}}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-1">Old Password</label>
                                    <input id="cc-pament" name="oldPassword" type="password"  class="form-control @if (session('notMach')) @endif @error('oldPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter old password">
                                    @error('oldPassword')
                                        <div class="invalid-feeback" style="color: red">
                                            {{ $message}}
                                        </div>
                                    @enderror
                                    @if (session('notMatch'))
                                    <div class="invalid-feeback" style="color: red">
                                        {{ session('notMatch')}}
                                    </div>
                                    @endif

                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">New Password</label>
                                    <input id="cc-pament" name="newPassword" type="password"  class="form-control @error('newPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter new password">
                                    @error('newPassword')
                                        <div class="invalid-feeback" style="color: red">
                                            {{ $message}}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-1">Confirm Password</label>
                                    <input id="cc-pament" name="confirmPassword" type="password"  class="form-control @error('confirmPassword') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter confirm password">
                                    @error('confirmPassword')
                                        <div class="invalid-feeback" style="color: red">
                                            {{ $message}}
                                        </div>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-dark text-white btn-block">
                                        <i class="fa-solid fa-key"></i>
                                        <span id="payment-button-amount">Change Password</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection

