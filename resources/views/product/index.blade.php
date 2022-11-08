@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-auto me-auto "><h2><b>Product</b> List</h2></div>
                    <div class="col-auto">
                        <a href={{route('product.create')}}>
                            <span class="btn btn add-new bg-dark text-white">+ Add New</span>
                        </a>
                    </div>
                </div>
            </div>

            <table class="table table-hover" id="index">
                <thead class="table-primary">
                <tr>
{{--                    sorting with laravel packages--}}
{{--                    <th>@sortablelink('id')</th>--}}
{{--                    <th>@sortablelink('product_translations.title', 'Title', [])</th>--}}
{{--                    <th>@sortablelink('product_translations.description', 'Description')</th>--}}
{{--                    <th>@sortablelink('price', 'Price')</th>--}}
{{--                    <th>@sortablelink('created_at', 'Created At')</th>--}}
{{--                    <th>@sortablelink('updated_at', 'Updated At')</th>--}}
{{--                    <th>Actions</th>--}}

{{--                    draw arrow for decrease and ascending order--}}
                    <th>@include('product.sort_link', ['column_name' => 'id', 'attribute' => 'id'])</th>
                    <th>@include('product.sort_link', ['column_name' => 'Title', 'attribute' => 'pt.title'])</th>
                    <th>@include('product.sort_link', ['column_name' => 'Description', 'attribute' => 'pt.description'])</th>
                    <th>@include('product.sort_link', ['column_name' => 'Price', 'attribute' => 'price'])</th>
                    <th>@include('product.sort_link', ['column_name' => 'Created At', 'attribute' => 'created_at'])</th>
                    <th>@include('product.sort_link', ['column_name' => 'Updated At', 'attribute' => 'updated_at'])</th>
                    <th>Actions</th>

                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->created_at->diffForHumans(['parts' => 2])}}</td>
                        <td>{{$item->updated_at->diffForHumans(['parts' => 2])}}</td>
                        <td>
                            @php
                                $id = $item->id;
                                $name = 'product';
//                            @endphp
                            <a href={{route('product.show', $id )}} class="btn" title="View" data-toggle="tooltip"><i class="fa fa-eye fa-2x" style="color: #323539"></i></a>
                            <a href={{route('product.edit', $id)}} class="btn" title="Edit" data-toggle="tooltip"><i class="material-icons" style="color: #323539">&#xE254;</i></a>
                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modalDelete{{$id, $name}}" title="Delete">
                                <i class="material-icons" style="color: #323539">&#xE872;</i>
                            </button>
                            @include('deleteConfModal')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // $(document).ready(function () {
        //     $('#index').DataTable({
        //         "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ]
        //     });
        // });
    </script>
@endpush
