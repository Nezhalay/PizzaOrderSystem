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
                                <h2 class="title-1">Admin List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{route('category#createPage')}}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add Admin
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
                            <form action="{{route('admin#list')}}" method="get">
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
                            <h3 class="d-flex"><i class="fa-solid fa-layer-group mr-2"></i> {{ $admin->total() }}</h3>
                        </div>
                    </div>

                    <div class="table-responsive table-responsive-data2 ">
                        <table class="table table-data2 text-center">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admin as $a)
                                <tr class="tr-shadow">
                                    <td  class="col-2">
                                    @if ($a->image == null )
                                        @if ($a->gender == 'male' )
                                            <img src="{{asset('image/male.jpg')}}" class="img-thumbnail shadow-sm" width="100px">
                                        @else
                                            <img src="{{asset('image/female.jpg')}}" class="img-thumbnail shadow-sm" width="100px">
                                        @endif
                                    @else
                                        <img src="{{asset('storage/'.$a->image)}}" class="img-thumbnail shadow-sm" width="100px">
                                    @endif
                                    </td>
                                    <td>{{ $a->name}}</td>
                                    <td>{{ $a->email}}</td>
                                    <td>{{ $a->gender}}</td>
                                    <td>{{ $a->phone}}</td>
                                    <td>{{ $a->address}}</td>
                                    <td>
                                        {{-- <a href="@if (Auth::user()->id == $a->id) # @else {{route('admin#delete',$a->id)}} @endif">
                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </a> --}}
                                        @if ( Auth::user()->id == $a->id)
                                        <i class="fa-solid fa-user-lock"></i>
                                        @else
                                            <a href="{{route('admin#changeRole',$a->id)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Admin change role ">
                                                    <i class="fa-solid fa-person-circle-minus me-1 fs-4"></i>
                                                </button>
                                            </a>
                                            <a href="{{route('admin#delete',$a->id)}}">
                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa-solid fa-trash-can me-1 fs-5"></i>
                                                </button>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $admin->links()}}
                            {{-- {{ $categories->appends(request()->query())->links()}} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
