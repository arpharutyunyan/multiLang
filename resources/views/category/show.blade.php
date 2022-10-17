@extends('layouts.app')

@section('content')

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>id</label>
                        <p><b>{{$category->id}}</b></p>
                    </div>
                    <div class="form-group">
                        @foreach(config('translatable.locales')::all() as $locale)
                            @php
                                $title = $locale['code'].'.title'
                            @endphp
                        <label>Title.{{$locale['code']}}</label>
                        <p><b>{{$category->$title}}</b></p>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label>Parent category</label>
                        <p><b>{{$category->parent}}</b></p>
                    </div>
                    <div class="form-group">
                        <label>Created At</label>
                        <p><b>{{$category->created_at}}</b></p>
                    </div>
                    <div class="form-group">
                        <label>Updated At</label>
                        <p><b>{{$category->updated_at}}</b></p>
                    </div>
                    <p><a href="{{route('category.index')}}" class="btn col-auto bg-dark text-white">Back</a></p>
                </div>
            </div>
        </div>
    </div>

@endsection
