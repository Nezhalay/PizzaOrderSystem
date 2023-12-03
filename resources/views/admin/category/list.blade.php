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
                                <h2 class="title-1">Category List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route('category#createPage')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add Category
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
                            <i class="fa-solid fa-xmark"></i> {{session('deleteSuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-4">
                            <h4 class="text-secondary">Search Key : <span class="text-danger">{{request('key')}}</span></h4>
                        </div>
                        <div class="col-3 offset-5 mb-2">
                            <form action="{{route('category#list')}}" method="get">
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
                            <h3 class="d-flex"><i class="fa-solid fa-layer-group mr-2"></i>{{$categories->total()}}</h3>
                        </div>
                    </div>

                    @if (count($categories) != 0 )
                    <div class="table-responsive table-responsive-data2 text-center">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Category Date</th>
                                    <th>CRUD</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr class="tr-shadow">
                                    <td>{{ $category->category_id}}</td>
                                    <td class="col-5">{{ $category->name}}</td>
                                    <td>{{ $category->created_at->format('j-F-Y')}}</td>
                                    <td>
                                        <div class="table-data-feature align-center">
                                            {{-- <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa-solid fa-eye"></i>
                                            </button> --}}
                                            <a href="{{route('category#edit',$category->category_id)}}">
                                                <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('category#delete',$category->category_id)}}">
                                                <button class="item me-1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $categories->links()}}
                            {{-- {{ $categories->appends(request()->query())->links()}} --}}
                        </div>
                    </div>
                    @else
                    <h3 class="text-secondery text-center mt-5">There is no categories here!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
