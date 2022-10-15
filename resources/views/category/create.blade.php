@extends('layouts.app')

@section('content')

    <form action={{route('category.store')}} method="POST">
        @csrf
        <div>
            <div class="form-group">
                @foreach(config('translatable.locales')::all() as $locale)
                    <label for="{{$locale['code']}}[title]">Title_{{$locale['code']}}</label>
                    <input type="text" class="form-control" name="{{$locale['code']}}[title]" placeholder="Input title"><br>
                @endforeach
            </div>
        </div>

        <div>
            <select name="parent_id" class="form-select form-select-md check">
                <option selected disabled>Choose categories for subCategory (parent_id)</option>
                @foreach($categories as $category)
                    <option value={{$category->id}}>{{$category->title}}</option>
                @endforeach
            </select><br>

            <button type="submit" class="btn btn col-auto bg-dark text-white m-5">Add</button>
        </div>
    </form>

@endsection
