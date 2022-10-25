@extends('layouts.app')

@section('content')

    <form action={{route('category.store')}} method="POST">
        @csrf
        <div style="width: 576px; margin: 0 auto;">

            @php
                $locales = config('translatable.locales')::all();
            @endphp

            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @foreach($locales as $locale)
                    <button class="nav-link @if($locale['code'] == app()->getLocale()) active @endif" data-bs-toggle="tab"
                            data-bs-target="#fields_{{$locale['code']}}" type="button" role="tab" aria-selected="true">
                        {{$locale['title']}}
                    </button>
                @endforeach
            </div>

            <div class="tab-content mt-2">
                @foreach($locales as $locale)
                    <div role="tabpanel" class="tab-pane @if($locale['code'] == app()->getLocale()) active @endif fade show" id="fields_{{$locale['code']}}" >

                        <label for="{{$locale['code']}}[title]">title_{{$locale['code']}}</label>
                        <input type="text" class="form-control" name="{{$locale['code']}}[title]" placeholder="Input title"><br>

                        @error($locale['code'].'.title')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                @endforeach
            </div>

            <div > {{--style="width: 600px; margin: 0 auto;">--}}
                <select name="parent_id" class="form-select form-select-md check">
                    <option selected disabled>Choose categories for subCategory (parent_id)</option>
                    @foreach($data as $item)
                        <option value={{$item->id}}>{{$item->title}}</option>
                    @endforeach
                </select><br>
            </div>

            <div class="row justify-content-end">
                <div class="col-auto col-sm-auto">
                    <a href="{{route('category.index')}}" class="btn btn-secondary ">Cancel</a>
                </div>
                <div class="col-auto col-sm-auto">
                    <button type="submit" class="btn btn bg-dark text-white">Add</button>
                </div>
            </div>
        </div>
    </form>

@endsection
