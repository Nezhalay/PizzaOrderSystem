@extends('admin.layout.master2')

@section('title','category list page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                {{-- <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{route('category#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div> --}}
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Profile</h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#update',Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-5 offset-3">
                                        <div class="col offset-3 image shadow-sm " style="width:200px">
                                            @if (Auth::user()->image == null )
                                                @if (Auth::user()->gender == 'male')
                                                    <img src="{{asset('image/male.jpg')}}" class="img-thumbnail shadow-sm">
                                                @else
                                                    <img src="{{asset('image/female.jpg')}}" class="img-thumbnail shadow-sm">
                                                @endif
                                            @else
                                                <img src="{{asset('storage/'.Auth::user()->image)}}" class="img-thumbnail shadow-sm" />
                                            @endif
                                        </div>
                                        <div class="shadow-sm mt-3">
                                            <input type="file" name="image" class="form-control  @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feeback" style="color: red">
                                                    {{ $message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6 offset-3">
                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="cc-pament" name="name" type="text" value="{{old('name',Auth::user()->name)}}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your name">
                                            @error('name')
                                                <div class="invalid-feeback" style="color: red">
                                                    {{ $message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="text" value="{{old('email',Auth::user()->email)}}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your email">
                                            @error('email')
                                                <div class="invalid-feeback" style="color: red">
                                                    {{ $message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="number" value="{{old('phone',Auth::user()->phone)}}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your phone">
                                            @error('phone')
                                                <div class="invalid-feeback" style="color: red">
                                                    {{ $message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Chose gender...</option>
                                                <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                            </select>
                                            @error('phone')
                                                <div class="invalid-feeback" style="color: red">
                                                    {{ $message}}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Address</label>
                                            <textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="5" placeholder="Enter your address">{{old('address',Auth::user()->address)}}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role" type="text" value="{{old('role',Auth::user()->role)}}" class="form-control " aria-required="true" aria-invalid="false" disabled>
                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2 offset-8">
                                        <button class="btn bg-dark text-white m-2">Update<i class="fa-solid fa-circle-chevron-right ml-2"></i></button>
                                    </div>
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

