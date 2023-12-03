@extends('user.layouts.master')

@section('content')
    <!-- Shop Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-4">
            <!-- Price Start -->
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by price</span></h5>
            <div class="bg-light p-4 mb-30">
                <form>
                    <div class="bg-dark px-3 py-2 text-white custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <label class="mt-2" for="price-all">Categories</label>
                        <span class="badge border font-weight-normal">{{count($category)}}</span>
                    </div>
                    <a href="{{route('user#home')}}">
                        <div class=" d-flex align-items-center justify-content-between mb-3 ">
                            <label  for="price-all"> All </label>
                        </div>
                    </a>
                    @foreach ($category as $c)
                            <div class=" d-flex align-items-center justify-content-between mb-3 ">
                                <a href="{{ route('user#filter',$c->category_id) }}"><label  for="price-all"> {{$c->name}} </label></a>
                            </div>
                    @endforeach

                </form>
            </div>
            <!-- Price End -->

            <div class="">
                <button class="btn btn btn-warning w-100">Order</button>
            </div>

        </div>
        <!-- Shop Sidebar End -->

        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-8">
            <div class="row pb-3">

                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div>
                            <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                            <a href=""><button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button></a>
                        </div>
                        <div class="ml-2">
                            <div class="btn-group">
                                {{-- <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Sorting</button> --}}
                                {{-- <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div> --}}
                                <select name="option" id="sortingOption" class="form-control">
                                    <option value="">Choose option...</option>
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>
                            {{-- <div class="btn-group ml-2">
                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">Showing</button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">10</a>
                                    <a class="dropdown-item" href="#">20</a>
                                    <a class="dropdown-item" href="#">30</a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>

            </div> {{-- pizza list  --}}
            <div class="row" id="dataList">
                @if (count($pizza) != 0 )
                @foreach ($pizza as $p)
                <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="myList">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" style="height: 250px" src="{{asset('storage/'.$p->image)}}" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=" "><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="{{route('user#pizzaDetails',$p->id)}} "><i class="fa-solid fa-circle-info"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="">{{$p->name}}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                {{-- <h6 class="text-muted ml-2"><del>25000</del></h6> --}}
                                <h5>{{$p->price}} Bath</h5>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                @else
                <div class="shadow-sm text-center fs-1 col-6 offset-3 py-5 text-warning bg-dark">  There is no Pizza <i class="fa-solid fa-pizza-slice text-warning"></i> </div>
                @endif
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){

            $('#sortingOption').change(function(){
                $eventOption = $('#sortingOption').val(),

                if($eventOption == 'asc'){
                    $.ajax({
                        type : 'get' ,
                        url  : 'http://127.0.0.1:8000/user/ajax/pizza/list',
                        data :  {
                                'status' : 'asc',
                                },
                        dataType : 'json',
                        success : function(response){
                            // console.log(response)
                            $list = '';
                            for($i=0;$i<response.length;$i++){
                                // console.log(`${response[$i].name}`);
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="myList">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 250px" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price} Bath</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `
                            }
                            $('#dataList').html($list);
                            console.log('This is asc...')
                        }
                    })
                }else if($eventOption == 'desc'){
                    $.ajax({
                        type : 'get' ,
                        url  : 'http://127.0.0.1:8000/user/ajax/pizza/list',
                        data :  { 'status' : 'desc'},
                        dataType : 'json',
                        success : function(response){
                            // console.log(response)
                            $list = '';
                            for($i=0;$i<response.length;$i++){
                                // console.log(`${response[$i].name}`);
                                $list += `
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="myList">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 250px" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                                <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>${response[$i].price} Bath</h5>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mb-1">
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                                <small class="fa fa-star text-primary mr-1"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `
                            }
                            $('#dataList').html($list);
                            console.log('This is desc...');
                        }
                    })
                }
            })

    });
</script>
@endsection
