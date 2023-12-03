@extends('admin.layout.master2')

@section('title','category list page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="ms-2">
                                <a href="{{route('admin#list')}}">
                                    <i class=" text-black fa-solid fa-angles-left"></i>
                                </a>
                            </div>
                            <div class="card-title">
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>
                            <hr>
                            <form action="{{ route('admin#change',$account->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <div class="col offset-1 image mt-3" style="width:300px">
                                            @if ($account->image == null )
                                                @if ($account->gender == 'male')
                                                    <img src="{{asset('image/male.jpg')}}" class="img-thumbnail shadow-sm">
                                                @else
                                                    <img src="{{asset('image/female.jpg')}}" class="img-thumbnail shadow-sm">
                                                @endif
                                            @else
                                                <img src="{{asset('storage/'.$account->image)}}" />
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
                                        {{-- click Update --}}
                                        <div class="col-2 offset-3">
                                            <div class="mt-2">
                                                <button class="btn bg-dark text-white m-2">Change<i class="fa-solid fa-circle-chevron-right ml-2"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col-6  ">
                                        <div class="">
                                            <div class="form-group mt-4">
                                                <label class="control-label mb-1">Name</label>
                                                <input id="cc-pament" disabled name="name" type="text" value="{{old('name',$account->name)}}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your name">
                                                @error('name')
                                                    <div class="invalid-feeback" style="color: red">
                                                        {{ $message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Role</label>
                                               <select name="role" class="form-control">
                                                <option value="admin" @if ($account->role == 'admin') selected @endif> Admin</option>
                                                <option value="user" @if ($account->role == 'user') selected @endif> User</option>
                                               </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Email</label>
                                                <input id="cc-pament" disabled name="email" type="text" value="{{old('email',$account->email)}}" class="form-control @error('email') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your email">
                                                @error('email')
                                                    <div class="invalid-feeback" style="color: red">
                                                        {{ $message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Phone</label>
                                                <input id="cc-pament" disabled name="phone" type="number" value="{{old('phone',$account->phone)}}" class="form-control @error('phone') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter your phone">
                                                @error('phone')
                                                    <div class="invalid-feeback" style="color: red">
                                                        {{ $message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Gender</label>
                                                <select name="gender" disabled class="form-control @error('gender') is-invalid @enderror">
                                                    <option value="">Chose gender...</option>
                                                    <option value="male" @if ($account->gender == 'male') selected @endif>Male</option>
                                                    <option value="female" @if ($account->gender == 'female') selected @endif>Female</option>
                                                </select>
                                                @error('phone')
                                                    <div class="invalid-feeback" style="color: red">
                                                        {{ $message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Address</label>
                                                <textarea name="address" disabled class="form-control @error('address') is-invalid @enderror" cols="30" rows="5" placeholder="Enter your address">{{old('address',$account->address)}}</textarea>
                                            </div>

                                        </div>
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

