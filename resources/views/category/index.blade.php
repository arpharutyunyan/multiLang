@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-auto me-auto "><h2><b>Category</b> List</h2></div>
                    <div class="col-auto">
                        <a href={{route('category.create')}}>
                            <span class="btn btn add-new bg-dark text-white">+ Add New</span>
                        </a>
                    </div>
                </div>
            </div>

            <table class="table table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>id</th>
                        <th>Parent id</th>
                        <th>Title</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->parent_id}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->updated_at}}</td>
                        <td>
                            @php
                                $id = $item->id;
                                $name = 'category';
                            @endphp
                            <a href={{route('category.show', $id )}} class="btn" title="View" data-toggle="tooltip"><i class="fa fa-eye fa-2x" style="color: #323539"></i></a>
                            <a href={{route('category.edit', $id)}} class="btn" title="Edit" data-toggle="tooltip"><i class="material-icons" style="color: #323539">&#xE254;</i></a>
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

