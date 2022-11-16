@extends('layouts.auth')

@section('content')

    <div class="wrapper">
        <div class="container d-flex justify-content-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3 text-rose">View Record</h1>
{{--                    <div class="form-group">--}}
{{--                        <label>id</label>--}}
{{--                        <p><b>{{$category->id}}</b></p>--}}
{{--                    </div>--}}
                    <div class="form-group">
                        @foreach(config('translatable.locales')::all() as $locale)
                            @php
                                $title = $locale['code'].'.title'
                            @endphp

                        <label>{{$title}}</label>
                        <p><b>{{$category->$title}}</b></p>
                        @endforeach
                    </div>
                    @if(isset($category->parent['title']))
                        <div class="form-group">
                            <label>Parent category</label>
                            <p><b>{{$category->parent['title']}}</b></p>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Created At</label>
                        <p><b>{{$category->created_at}}</b></p>
                    </div>
                    <div class="form-group">
                        <label>Updated At</label>
                        <p><b>{{$category->updated_at}}</b></p>
                    </div>
                    <p><a href="{{route('category.index')}}" class="btn btn-fill btn-rose">Back</a></p>
                </div>
            </div>
        </div>
    </div>

@endsection
