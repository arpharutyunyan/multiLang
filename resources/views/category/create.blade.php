@extends('layouts.app')

@section('content')

    <form action={{route('category.store')}} method="POST">
        @csrf
        <div>
            <div class="form-group">
                @foreach(config('app.locales')::all() as $locale)
                    <label for="{{$locale['code']}}[title]">Title_{{$locale['code']}}</label>
                    <input type="text" class="form-control" name="{{$locale['code']}}[title]" placeholder="Input title"><br>
                @endforeach
            </div>
        </div>

        <div>
            <label for="price">Price</label>
            <input type="number" class="form-control" name="price"><br>
            <button type="submit" class="btn btn col-auto bg-dark text-white">Add</button>
        </div>
    </form>

@endsection
