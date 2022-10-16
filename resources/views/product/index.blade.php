@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2><b>Product</b> List</h2></div>
                    <div class="col-sm-4">
                        <a href={{route('product.create')}}>
                            <span class="btn btn add-new col-auto bg-dark text-white">Add New</span>
                        </a>
                    </div>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Category id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->category_id}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->updated_at}}</td>
                        <td>
                            @php
                                $id = $item->id;
                                $name = 'product';
                            @endphp
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

