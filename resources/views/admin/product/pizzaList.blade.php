@extends('admin.layout.master2')

@section('title','category list page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Products List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route('product#createPage')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Pizza
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    @if (session('deleteSuccess'))
                    <div class="col-4 offset-8">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-check"></i> {{session('deleteSuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-4">
                            <h4 class="text-secondary">Search Key : <span class="text-danger">{{request('key')}}</span></h4>
                        </div>
                        <div class="col-3 offset-5 mb-2">
                            <form action="{{route('product#list')}}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="text" name="key" class="form-control" placeholder="Search..." value="{{request('key')}}">
                                    <button class="btn btn-dark " type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-1 offset-10 bg-white text-center shadow-sm py-2">
                            <h3 class="d-flex"><i class="fa-solid fa-layer-group mr-2"></i>{{ $pizzas->total() }}</h3>
                        </div>
                    </div>

                    {{-- Pizza Data product list Table --}}
                    @if (count($pizzas) != 0)
                    <div class="table-responsive table-responsive-data2 text-center">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Pizza Image</th>
                                    <th>Pizza Name</th>
                                    <th>Pizza price</th>
                                    <th>Category</th>
                                    <th>View</th>
                                    <th>CRUD</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($pizzas as $p)
                                        <tr class="tr-shadow">
                                            <td class="col-2"><img src="{{asset('storage/'. $p->image)}}" class="img-thumbnail shadow-sm"></td>
                                            <td class="col-2">{{ $p->name}}</td>
                                            <td class="col-2">{{ $p->price}}</td>
                                            <td class="col-2">{{ $p->category_name }}</td>
                                            <td class="col-2"><i class="fa-regular fa-eye"></i> {{ $p->view_count}}</td>
                                            <td class="col-2">
                                                <div class="table-data-feature align-center">
                                                    <a href="{{ route('product#edit',$p->category_id)}}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top" title="view">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{route('product#updatePage',$p->id)}}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#delete',$p->category_id) }}">
                                                        <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $pizzas->links()}}
                        </div>
                    </div>
                    @else
                        <h3 class="text-secondery text-center mt-5">There is no categories here!</h3>
                    @endif
                    <!-- END Pizza DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
