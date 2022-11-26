@extends('layouts.auth')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 ml-auto mr-auto">
                <form action="{{isset($category) ? route('category.update', $category) : route('category.store')}}" method="POST">
                    @csrf

                    @if(isset($category))
                        @method('PUT')
                    @endif

                    <ul class="nav nav-pills nav-pills-rose" role="tablist">

                        @php
                            $locales = config('translatable.locales')::all()
                        @endphp

                        @foreach($locales as $locale)
                            <li class="nav-item">
                                <a class="nav-link @if($locale['code'] == app()->getLocale()) active @endif" data-toggle="tab" href="#fields_{{$locale['code']}}" role="tablist">
                                    {{$locale['title']}}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">list</i>
                            </div>
                            <h4 class="card-title">New Record</h4>
                        </div>
                        <div class="card-body ">
                            <div class="tab-content tab-space">
                                @foreach($locales as $locale)
                                    @php
                                        $title = $locale['code'].'.title'
                                    @endphp
                                    <div class="form-group tab-pane @if($locale['code'] == app()->getLocale()) active @endif show" id="fields_{{$locale['code']}}">
                                        <label for="{{$locale['code']}}[title]" class="bmd-label-floating">Title ({{$locale['code']}})</label>
                                        <input type="text" class="form-control" @if(isset($category)) value="{{$category->$title}}" @endif name="{{$locale['code']}}[title]">

                                        @error($title)
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                @endforeach
                            </div>

                            <label class="text-primary">Parent category</label><br>

                            <select name="parent_id" class="selectpicker form-control" data-style="select-with-transition" title="Choose parent category" data-live-search="true">

                                @if(isset($category->parent['item']))
                                    <option selected value="{{$category->parent['item']}}">{{$category->parent['title']}}</option>
                                    @foreach($data as $item)
                                        @if($item->title != $category->parent['title'])
                                            <option value={{$item->id}}>{{$item->title}}</option>
                                        @endif
                                    @endforeach
                                @endif

                                @foreach($data as $item)
                                    <option value={{$item->id}}>{{$item->title}}</option>
                                @endforeach

                            </select>
                            <div class="card-footer ">
                                <a href="{{route('category.index')}}" class="btn mt-5" style="border-color: black">Cancel</a>
                                <input type="submit" class="btn btn-fill btn-rose col-auto mt-5" value="Submit">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
