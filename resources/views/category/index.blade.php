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

            <table class="table table-hover" id="index">
                <thead class="table-primary">
                    <tr>
                        <th>id</th>
                        <th>Parent category</th>
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
                        @php
                            $hasParent = false
                        @endphp

{{--                        find the parent category id in given data--}}
                        @foreach($data as $parent)
                            @if($parent->id == $item->parent_id)
                                @php
                                    $hasParent = true
                                @endphp
                                @break
                            @endif
                        @endforeach

{{--                        if find and break get parent category title --}}
                        <td>
                            @if($hasParent)
                                {{$parent->title}}
                            @else
                                -
                            @endif
                        </td>

                        <td>{{$item->title}}</td>
                        <td>{{$item->created_at->diffForHumans(['parts' => 2])}}</td>
                        <td>{{$item->updated_at->diffForHumans(['parts' => 2])}}</td>
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

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#index').DataTable({
                "lengthMenu": [ [5, 10, 25, 50, -1], [5, 10, 25, 50, "All"] ]
            });
        });
    </script>
@endpush

