@extends('layouts.auth')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">

                        <div class="card-icon">
                            <a href="{{route('product.create')}}" >
                                <i class="material-icons" style="color: white">add</i>
                            </a>
                        </div>

                        <h4 class="card-title">Products</h4>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{$item->id}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>{{$item->price}}</td>
                                        <td data-sort="{{$item->created_at}}">{{$item->created_at->diffForHumans(['parts' => 2])}}</td>
                                        <td data-sort="{{$item->updated_at}}">{{$item->updated_at->diffForHumans(['parts' => 2])}}</td>
                                        <td class="td-actions text-right">
                                            @php
                                                $id = $item->id;
                                                $name = 'product';
                                            @endphp
                                            <form name="myForm" id="item_{{$id}}" action="{{route($name.'.destroy', $id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{route('product.show', $id )}}" class="btn btn-info btn-round"><i class="material-icons">art_track</i></a>
                                                <a href="{{route('product.edit', $id)}}" class="btn btn-success btn-round"><i class="material-icons">edit</i></a>
                                                <button type="submit" class="btn btn-danger btn-round" onclick="demo.showSwal('warning-message-and-cancel',{{$id}})" value="{{$id}}"><i class="material-icons">close</i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
@endsection

@push('script')
    <script>

        $(document).ready(function() {
            $('#datatables').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "INPUT",
                    searchPlaceholder: "Search records",
                }
            });

            var table = $('#datatables').DataTable();
        })
    </script>

    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <script>
        $(document).ready(function() {
            // Initialise Sweet Alert library
            demo.showSwal();
        });
    </script>
@endpush



{{--@extends('layouts.auth')--}}

{{--@section('content')--}}

{{--    <div class="container">--}}

{{--        <div class="table-wrapper">--}}
{{--            <div class="table-title">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-auto me-auto "><h2><b>Product</b> List</h2></div>--}}
{{--                    <div class="col-auto">--}}
{{--                        <a href={{route('product.create')}}>--}}
{{--                            <span class="btn btn add-new bg-dark text-white">+ Add New</span>--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <table class="table table-hover" id="index">--}}
{{--                <thead class="table-primary">--}}
{{--                <tr>--}}
{{--                    sorting with laravel packages--}}
{{--                    <th>@sortablelink('id')</th>--}}
{{--                    <th>@sortablelink('product_translations.title', 'Title', [])</th>--}}
{{--                    <th>@sortablelink('product_translations.description', 'Description')</th>--}}
{{--                    <th>@sortablelink('price', 'Price')</th>--}}
{{--                    <th>@sortablelink('created_at', 'Created At')</th>--}}
{{--                    <th>@sortablelink('updated_at', 'Updated At')</th>--}}
{{--                    <th>Actions</th>--}}

{{--                    draw arrow for decrease and ascending order--}}
{{--                    <th>@include('product.sort_link', ['column_name' => 'id', 'attribute' => 'id'])</th>--}}
{{--                    <th>@include('product.sort_link', ['column_name' => 'Title', 'attribute' => 'pt.title'])</th>--}}
{{--                    <th>@include('product.sort_link', ['column_name' => 'Description', 'attribute' => 'pt.description'])</th>--}}
{{--                    <th>@include('product.sort_link', ['column_name' => 'Price', 'attribute' => 'price'])</th>--}}
{{--                    <th>@include('product.sort_link', ['column_name' => 'Created At', 'attribute' => 'created_at'])</th>--}}
{{--                    <th>@include('product.sort_link', ['column_name' => 'Updated At', 'attribute' => 'updated_at'])</th>--}}
{{--                    <th>Actions</th>--}}

{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach($data as $item)--}}
{{--                    <tr>--}}
{{--                        <td>{{$item->id}}</td>--}}
{{--                        <td>{{$item->title}}</td>--}}
{{--                        <td>{{$item->description}}</td>--}}
{{--                        <td>{{$item->price}}</td>--}}
{{--                        <td>{{$item->created_at->diffForHumans(['parts' => 2])}}</td>--}}
{{--                        <td>{{$item->updated_at->diffForHumans(['parts' => 2])}}</td>--}}
{{--                        <td>--}}
{{--                            @php--}}
{{--                                $id = $item->id;--}}
{{--                                $name = 'product';--}}
{{--//                            @endphp--}}
{{--                            <a href={{route('product.show', $id )}} class="btn" title="View" data-toggle="tooltip"><i class="fa fa-eye fa-2x" style="color: #323539"></i></a>--}}
{{--                            <a href={{route('product.edit', $id)}} class="btn" title="Edit" data-toggle="tooltip"><i class="material-icons" style="color: #323539">&#xE254;</i></a>--}}
{{--                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalDelete{{$id, $name}}" title="Delete">--}}
{{--                                <i class="material-icons" style="color: #323539">&#xE872;</i>--}}
{{--                            </button>--}}
{{--                            @include('deleteConfModal')--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

