@extends('layouts.app')

@section('content')
    <div class="wrapper" style="width: 600px; margin: 0 auto;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the subject record.</p>
                    <form action={{route('category.update', $category)}} method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>id</label>
                            <input type="text" name="id" class="form-control" value={{$category->id}} disabled>
                        </div>

                        @foreach(config('translatable.locales')::all() as $locale)

                            @php
                                $title = $locale['code'].'.title'
                            @endphp

                            <div class="form-group mt-2">
                                <label>New title_{{$locale['code']}}</label>
                                <input type="text" value="{{$category->$title}}" name="{{$locale['code']}}[title]" class="form-control">

                                @error($title)
                                <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>

                        @endforeach

                        <div class="form-group mt-2">
                            <label>New parent_id</label>
                            <div class="form-group mt-2">
                                <label for="parent_id">Choose parent category</label>
                                <select name="parent_id">
                                    <option selected value="{{$category->parent_id}}">{{$category->parent_id}}</option>
                                    @foreach($categories as $item)
                                        <option value={{$item->id}}>{{$item->title}}</option>
                                    @endforeach
                                </select>

                                @error('parent_id')
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
