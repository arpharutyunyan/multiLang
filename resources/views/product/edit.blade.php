@extends('layouts.app')

@section('content')
    <div class="wrapper" style="width: 600px; margin: 0 auto;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the subject record.</p>
                    <form action={{route('product.update', $product)}} method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>id</label>
                            <input type="text" name="id" class="form-control" value={{$product->id}} disabled>
                        </div>

                        @foreach(config('translatable.locales')::all() as $locale)

                            @php
                                $title = $locale['code'].'.title';
                                $description = $locale['code'].'.description'
                            @endphp

                            <div class="form-group mt-2">
                                <label>New title_{{$locale['code']}}</label>
                                <input type="text" value="{{$product->$title}}" name="{{$locale['code']}}[title]" class="form-control">

                                @error($title)
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror

                                <label>New description_{{$locale['code']}}</label>
                                <input type="text" value="{{$product->$description}}" name="{{$locale['code']}}[description]" class="form-control">

                                @error($description)
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>

                        @endforeach

                        <label for="price">New price</label>
                        <input type="number" class="form-control" name="price" placeholder="{{$product->price}}" value="{{$product->price}}"><br>

                        <div class="form-group mt-2">
                            <label>New category id</label>
                            <div class="form-group mt-2">
                                <label for="category_id">Choose parent category</label>
                                <select name="category_id">
{{--                                    <option selected value="{{$category->id}}">{{$category->id}}</option>--}}
                                    @foreach($categories as $item)
                                        <option value={{$item->id}}>{{$item->title}}</option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <input type="submit" class="btn col-auto bg-dark text-white mt-2" value="Submit">
                        <a href="{{route('category.index')}}" class="btn mt-2" style="border-color: black">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
