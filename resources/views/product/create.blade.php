@extends('layouts.app')

@section('content')

    <form action={{route('product.store')}} method="POST">
        @csrf
        <div style="width: 600px; margin: 0 auto;">
            <div class="form-group">
                @php
                    $locales = config('translatable.locales')::all()
                @endphp

                @foreach($locales as $locale)
                    <label for="{{$locale['code']}}[title]">title_{{$locale['code']}}</label>
                    <input type="text" class="form-control" name="{{$locale['code']}}[title]" placeholder="Input title"><br>

                    @error($locale['code'].'.title')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror

                    <label for="{{$locale['code']}}[description]">description_{{$locale['code']}}</label>
                    <input type="text" class="form-control" name="{{$locale['code']}}[description]" placeholder="Input description"><br>

                    @error($locale['code'].'.description')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                @endforeach
            </div>
        </div>

        <div style="width: 600px; margin: 0 auto;">

            <label for="price">Price</label>
            <input type="number" class="form-control" name="price"><br>

            <select name="category_id" class="form-select form-select-md check">
                <option selected disabled>Choose categories</option>
                @foreach($categories as $item)
                    <option value={{$item->id}}>{{$item->title}}</option>
                @endforeach
            </select><br>

            <button type="submit" class="btn btn col-auto bg-dark text-white m-5">Add</button>
        </div>
    </form>

@endsection
