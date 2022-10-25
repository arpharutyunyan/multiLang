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

                        @php
                            $locales = config('translatable.locales')::all()
                        @endphp

                        <div class="nav nav-tabs mb-2" id="nav-tab" role="tablist">
                            @foreach($locales as $locale)
                                <button class="nav-link @if($locale['code'] == app()->getLocale()) active @endif" data-bs-toggle="tab"
                                        data-bs-target="#fields_{{$locale['code']}}" type="button" role="tab" aria-selected="true">
                                    {{$locale['title']}}
                                </button>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label>id</label>
                            <input type="text" name="id" class="form-control" value={{$category->id}} disabled>
                        </div>

                        <div class="tab-content mt-3">
                            @foreach($locales as $locale)
                                @php
                                    $title = $locale['code'].'.title'
                                @endphp

                                <div role="tabpanel" class="tab-pane @if($locale['code'] == app()->getLocale()) active @endif fade show" id="fields_{{$locale['code']}}" >

                                    <label class="text-primary">New {{$title}}</label>
                                    <input type="text" value="{{$category->$title}}" name="{{$locale['code']}}[title]" class="form-control">

                                    @error($title)
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>

                            @endforeach
                        </div>

                        <div class="form-group mt-3">
                            <label class="text-primary">New parent_id</label>
                            <div class="form-group mt-2">
                                <label for="parent_id">Choose parent category</label>
                                <select name="parent_id">
                                    <option value="">None</option>

                                    @if(isset($category->parent['item']))
                                        <option selected value="{{$category->parent['item']}}">{{$category->parent['title']}}</option>
                                        @foreach($categories as $item)
                                            @if($item->title != $category->parent['title'])
                                                <option value={{$item->id}}>{{$item->title}}</option>
                                            @endif
                                        @endforeach
                                    @endif

                                    @foreach($categories as $item)
                                        <option value={{$item->id}}>{{$item->title}}</option>
                                    @endforeach

                                </select>

                            </div>
                        </div>

                        <input type="submit" class="btn col-auto bg-dark text-white mt-5" value="Submit">
                        <a href="{{route('category.index')}}" class="btn mt-5" style="border-color: black">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
