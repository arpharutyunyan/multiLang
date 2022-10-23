@extends('layouts.app')

@section('content')

    <form action={{route('category.store')}} method="POST">
        @csrf
        <div style="width: 600px; margin: 0 auto;">

            @php
                $locales = config('translatable.locales')::all();
            @endphp

            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                @foreach($locales as $locale)
                    <button class="lang nav-link @if($locale['code'] == app()->getLocale()) active @endif" data-bs-toggle="tab"
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

                        </div>
                @endforeach
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
        </div>
    </form>

@endsection
