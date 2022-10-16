@extends('layouts.app')

@section('content')

    <form action={{route('category.store')}} method="POST">
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
                @endforeach
            </div>
        </div>

        <div style="width: 600px; margin: 0 auto;">
            <select name="parent_id" class="form-select form-select-md check">
                <option selected disabled>Choose categories for subCategory (parent_id)</option>
                @foreach($data as $item)
                    <option value={{$item->id}}>{{$item->title}}</option>
                @endforeach
            </select><br>

            <button type="submit" class="btn btn col-auto bg-dark text-white m-5">Add</button>
        </div>
    </form>

@endsection
