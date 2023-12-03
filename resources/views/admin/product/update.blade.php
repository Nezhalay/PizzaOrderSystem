@extends('admin.layout.master2')

@section('title','category list page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                {{-- <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div> --}}
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            {{-- back click --}}
                            <div class="ml-3">
                                <i class="fa-solid fa-angles-left" onclick="history.back()"></i>
                            </div>

                            <div class="card-title">
                                <h3 class="text-center title-2">Update Pizza</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4 offset-1">
                                        <input type="hidden" name="ID" value="{{ $pizza->id}}">
                                        {{-- image --}}
                                        <div class="image shadow-sm col offset-1 mt-4" style="width:250px">
                                            <img src="{{asset('storage/'.$pizza->image)}}" />
                                        </div>
                                        {{-- file image --}}
                                        <div class="shadow-sm mt-3">
                                            <input type="file" name="pizzaImage" class="form-control  @error('pizzaImage') is-invalid @enderror">
                                            @error('pizzaImage')
                                                <div class="invalid-feeback" style="color: red">
                                                    {{ $message}}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- click Update --}}
                                        <div class="col-2 offset-3">
                                            <div class="mt-2">
                                                <button class="btn bg-dark text-white m-2">Update<i class="fa-solid fa-circle-chevron-right ml-2"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row col-6 ">
                                        <div class="mt-4">
                                            <div class="form-group">
                                                <label class="control-label mb-1">Pizza Name</label>
                                                <input id="cc-pament" name="pizzaName" type="text" value="{{old('pizzaName',$pizza->name)}}" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter name">
                                                @error('pizzaName')
                                                    <div class="invalid-feeback" style="color: red">
                                                        {{ $message}}
                                                    </div>
                                                @enderror
                                            </div>
                                            {{-- update data --}}
                                            <div class="form-group">
                                                <label class="control-label mb-1">Pizza Category</label>
                                                <select name=" pizzaCategory" class="form-control @error(' pizzaCategory ') is-invalid @enderror">
                                                    <option value="">Chose Pizza Category...</option>
                                                    @foreach ($category as $c)
                                                    <option value="{{ $c->category_id }}" @if ( $pizza->category_id == $c->category_id ) selected @endif>{{$c->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('pizzaCategory')
                                                    <div class="invalid-feeback" style="color: red">
                                                        {{ $message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Description</label>
                                                <textarea name="pizzaDescription" class="form-control @error('pizzaDescription') is-invalid @enderror" cols="30" rows="5" placeholder="Enter your pizzaDescription">{{old('pizzaDescription',$pizza->description)}}</textarea>
                                                @error('pizzaDescription')
                                                    <div class="invalid-feeback" style="color: red">
                                                        {{ $message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Price</label>
                                                <input id="cc-pament" name="pizzaPrice" type="number" value="{{old('pizzaPrice',$pizza->price)}}" class="form-control @error('pizzaPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter pizzaPrice">
                                                @error('pizzaPrice')
                                                    <div class="invalid-feeback" style="color: red">
                                                        {{ $message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Winting Time</label>
                                                <input id="cc-pament" name="waitingTime" type="number" value="{{old('waitingTime',$pizza->waiting_time)}}" class="form-control @error('wintingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter wintingTime">
                                                @error('waitingTime')
                                                    <div class="invalid-feeback" style="color: red">
                                                        {{ $message}}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">View count</label>
                                                <input id="cc-pament" name="viewCount" type="number" value="{{old('viewCount',$pizza->view_count)}}" class="form-control @error('viewCount') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label mb-1">Created Date</label>
                                                <input id="cc-pament" name="created_at" type="text" value="{{ $pizza->created_at->format('j-F-Y') }}" class="form-control @error('created_at') is-invalid @enderror" aria-required="true" aria-invalid="false">
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

