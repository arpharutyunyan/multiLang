@extends('layouts.app')

@section('content')

    <div class="wrapper">
        <div class="container d-flex justify-content-center">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>id</label>
                        <p><b>{{$product->id}}</b></p>
                    </div>
                    <div class="form-group">
                        @foreach(config('translatable.locales')::all() as $locale)
                            @php
                                $title = $locale['code'].'.title';
                                $description = $locale['code'].'.description'
                            @endphp
                            <label>{{$title}}</label>
                            <p><b>{{$product->$title}}</b></p>
                            <label>{{$description}}</label>
                            <p><b>{{$product->$description}}</b></p>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <p><b>{{$product->price}}</b></p>
                    </div>
                    <div class="form-group">
                        <label>Category id</label>
                        <p><b>{{$product->parent['title']}}</b></p>
                    </div>
                    <div class="form-group">
                        <label>Created At</label>
                        <p><b>{{$product->created_at}}</b></p>
                    </div>
                    <div class="form-group">
                        <label>Updated At</label>
                        <p><b>{{$product->updated_at}}</b></p>
                    </div>
                    <p><a href="{{route('product.index')}}" class="btn col-auto bg-dark text-white">Back</a></p>
                </div>
            </div>
        </div>
    </div>

@endsection
