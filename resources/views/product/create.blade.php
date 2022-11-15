@extends('layouts.auth')

@section('content')

    <form action={{route('product.store')}} method="POST">
        @csrf
        <div style="width: 600px; margin: 0 auto;">
            <div class="form-group">
                @php
                    $locales = config('translatable.locales')::all()
                @endphp

                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    @foreach($locales as $locale)
                        <button class="nav-link @if($locale['code'] == app()->getLocale()) active @endif" data-bs-toggle="tab"
                                data-bs-target="#fields_{{$locale['code']}}" type="button" role="tab" aria-selected="true">
                            {{$locale['title']}}
                        </button>
                    @endforeach
                </div>

                <div class="tab-content mt-3">
                    @foreach($locales as $locale)
                        <div role="tabpanel" class="tab-pane @if($locale['code'] == app()->getLocale()) active @endif fade show" id="fields_{{$locale['code']}}" >

                            <label for="{{$locale['code']}}[title]">Title ({{$locale['code']}})</label>
                            <input type="text" class="form-control" name="{{$locale['code']}}[title]" placeholder="Input title"><br>

                            @error($locale['code'].'.title')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror

                            <label for="{{$locale['code']}}[description]">Description ({{$locale['code']}})</label>
                            <textarea  name="{{$locale['code']}}[description]" class="form-control mt-2" placeholder="Input description"></textarea>

                            @error($locale['code'].'.description')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror

                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        <div style="width: 600px; margin: 0 auto;">

            <label for="price" class="mt-3">Price</label>
            <input type="number" class="form-control" name="price"><br>
            @error('price')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror

            <select name="category_id" class="form-control" id="select">
                <option></option>
                @foreach($categories as $item)
                    <option value={{$item->id}}>{{$item->title}}</option>
                @endforeach
            </select><br>

            @error('category_id')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror

            <div class="row justify-content-end mt-5">
                <div class="col-auto col-sm-auto">
                    <button type="submit" class="btn btn bg-dark text-white">Add</button>
                </div>
                <div class="col-auto col-sm-auto">
                    <a href="{{route('product.index')}}" class="btn btn-secondary ">Cancel</a>
                </div>
            </div>
        </div>
    </form>



@endsection

@push('scripts')
    <script>

        $(document).ready(function() {
            $("#select").select2({
                placeholder: "Choose category",
                theme: "classic",
                allowClear: true,

            });
        });

    </script>
@endpush


