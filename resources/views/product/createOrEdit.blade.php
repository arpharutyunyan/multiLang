@extends('layouts.auth')

@section('content')
    <div class="container-fluid">

        <form class="ml-auto mr-auto" action="{{isset($product) ? route('product.update', $product) : route('product.store')}}" method="POST">
            @csrf

            @if(isset($product))
                @method('PUT')
            @endif
            <div class="language">
                <ul class="nav nav-pills nav-pills-rose" role="tablist">

                    @php
                        $locales = config('translatable.locales')::all()
                    @endphp

                    @foreach($locales as $locale)
                        <li class="nav-item">
                            <a class="nav-link @if($locale['code'] == app()->getLocale()) active @endif" data-toggle="tab"  href="#fields_{{$locale['code']}}" role="tablist">
                                {{$locale['title']}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mt-auto ml-auto mr-auto ">
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
                                            $title = $locale['code'].'.title';
                                            $description = $locale['code'].'.description'
                                        @endphp
                                        <div class="tab-pane @if($locale['code'] == app()->getLocale()) active @endif show" id="fields_{{$locale['code']}}">
                                            <label for="{{$locale['code']}}[title]" class="bmd-label-floating">Title ({{$locale['code']}})</label>
                                            <input type="text" class="form-control" @if(isset($product)) value="{{$product->$title}}" @endif name="{{$locale['code']}}[title]">

                                            @error($title)
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror

                                            <label for="{{$locale['code']}}[description]" class="bmd-label-floating mt-3">Description ({{$locale['code']}})</label>
                                            <textarea id="{{'language'.$locale['code']}}" class="form-control" name="{{$locale['code']}}[description]">{{(isset($product)) ? $product->$description : ''}}</textarea>

                                            @error($description)
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                        </div>

                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-auto ml-auto mr-auto">

                        <div class="card ">
                            <div class="card-header card-header-rose card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">list</i>
                                </div>
                                {{--                        <h4 class="card-title">Stacked Form</h4>--}}
                            </div>
                            <div class="card-body ">

                                <div class="form-group">
                                    <label class="text-primary">Parent category</label>
                                    <select name="category_id" class="selectpicker form-control mt-auto" data-style="select-with-transition" title="Choose parent category" data-live-search="true">
                                        <option @if(isset($product)) selected value="{{$product->parent['item']}}" @endif>{{$product->parent['title'] ?? ''}}</option>

                                        @foreach($categories as $item)
                                            @if(isset($product))
                                                @if($item->title != $product->parent['title'])
                                                    <option value={{$item->id}}>{{$item->title}}</option>
                                                @endif
                                            @else
                                                <option value={{$item->id}}>{{$item->title}}</option>
                                            @endif
                                        @endforeach
                                    </select><br>

                                    @error('category_id')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="text-primary">Manufacturer</label>
                                    <select name="manufacturer_id" class="selectpicker form-control mt-auto" data-style="select-with-transition" title="Choose brand" data-live-search="true">
                                        <option @if(isset($product)) selected value="{{$product->manufacturer['id']}}" @endif>{{$product->manufacturer['title'] ?? ''}}</option>

                                        @foreach($manufacturers as $item)
                                            @if(isset($product))
                                                @if($item->title != $product->manufacturer['title'])
                                                    <option value={{$item->id}}>{{$item->title}}</option>
                                                @endif
                                            @else
                                                <option value={{$item->id}}>{{$item->title}}</option>
                                            @endif
                                        @endforeach
                                    </select><br>

                                    @error('manufacturer_id')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 ">
                    <div class="card ">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">details</i>
                            </div>
                            <h4 class="card-title">Details</h4>
                        </div>
                        <div class="card-body ">

                            <div class="row">
                                <label class="col-sm-2 col-form-label">Price</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="price" @if(isset($product)) value="{{$product->price}}" @endif>
                                    </div>
                                    @error('price')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label">Screen size</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="screen_size" @if(isset($product)) value="{{$product->screen_size}}" @endif>
                                    </div>
                                </div>
                                <label class="col-sm-3 label-on-right">
                                    <code>inch</code>
                                </label>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label">RAM</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="ram" @if(isset($product)) value="{{$product->ram}}" @endif>
                                    </div>
                                </div>
                                <label class="col-sm-3 label-on-right">
                                    <code>GB</code>
                                </label>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label">Memory</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="memory" @if(isset($product)) value="{{$product->memory}}" @endif>
                                    </div>
                                </div>
                                <label class="col-sm-3 label-on-right">
                                    <code>GB</code>
                                </label>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label">Main camera</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="main_camera" @if(isset($product)) value="{{$product->main_camera}}" @endif>
                                    </div>
                                </div>
                                <label class="col-sm-3 label-on-right">
                                    <code>MP</code>
                                </label>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label">Front camera</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="front_camera" @if(isset($product)) value="{{$product->front_camera}}" @endif>
                                    </div>
                                </div>
                                <label class="col-sm-3 label-on-right">
                                    <code>MP</code>
                                </label>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label">Battery capacity</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="battery_capacity" @if(isset($product)) value="{{$product->battery_capacity}}" @endif>
                                    </div>
                                </div>
                                <label class="col-sm-3 label-on-right">
                                    <code>mAh</code>
                                </label>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label">Operating system</label>
                                <div class="col-sm-7">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="os" @if(isset($product)) value="{{$product->os}}" @endif>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-end">
                <div class="col-auto col-sm-auto">
                    <a href="{{route('product.index')}}" class="btn" style="border-color: black">Cancel</a>
                </div>

                <div class="col-auto col-sm-auto">
                    <input type="submit" class="btn btn-fill btn-rose col-auto" value="Submit">
                </div>
            </div>

        </form>

    </div>

@endsection

@push('script')
    <script>

        let item = document.querySelectorAll('[id^="language"]');
        console.log(item);

        for (let i=0; i<item.length; ++i){
            ClassicEditor
                .create(item[i], {
                    removePlugins: ["EasyImage", "ImageUpload", "MediaEmbed"],
                })

                .catch(error => {
                    console.error(error);
                });
        }

    </script>

@endpush

{{--@extends('layouts.auth')--}}

{{--@section('content')--}}
{{--    <div class="container-fluid">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-6 ml-auto mr-auto">--}}
{{--                <form action="{{isset($product) ? route('product.update', $product) : route('product.store')}}" method="POST">--}}
{{--                    @csrf--}}

{{--                    @if(isset($product))--}}
{{--                        @method('PUT')--}}
{{--                    @endif--}}

{{--                    <ul class="nav nav-pills nav-pills-rose" role="tablist">--}}

{{--                        @php--}}
{{--                            $locales = config('translatable.locales')::all()--}}
{{--                        @endphp--}}

{{--                        @foreach($locales as $locale)--}}
{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link @if($locale['code'] == app()->getLocale()) active @endif" data-toggle="tab"  href="#fields_{{$locale['code']}}" role="tablist">--}}
{{--                                    {{$locale['title']}}--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}

{{--                    <div class="card">--}}
{{--                        <div class="card-header card-header-rose card-header-icon">--}}
{{--                            <div class="card-icon">--}}
{{--                                <i class="material-icons">list</i>--}}
{{--                            </div>--}}
{{--                            <h4 class="card-title">New Record</h4>--}}
{{--                        </div>--}}
{{--                        <div class="card-body ">--}}
{{--                            <div class="tab-content tab-space">--}}
{{--                                @foreach($locales as $locale)--}}
{{--                                    @php--}}
{{--                                        $title = $locale['code'].'.title';--}}
{{--                                        $description = $locale['code'].'.description'--}}
{{--                                    @endphp--}}
{{--                                    <div class="tab-pane @if($locale['code'] == app()->getLocale()) active @endif show" id="fields_{{$locale['code']}}">--}}
{{--                                        <label for="{{$locale['code']}}[title]" class="bmd-label-floating">Title ({{$locale['code']}})</label>--}}
{{--                                        <input type="text" class="form-control" @if(isset($product)) value="{{$product->$title}}" @endif name="{{$locale['code']}}[title]">--}}

{{--                                        @error($title)--}}
{{--                                        <div class="alert alert-danger">{{$message}}</div>--}}
{{--                                        @enderror--}}

{{--                                        <label for="{{$locale['code']}}[description]" class="bmd-label-floating mt-3">Description ({{$locale['code']}})</label>--}}
{{--                                        <textarea id="{{'language'.$locale['code']}}" class="form-control" name="{{$locale['code']}}[description]">{{(isset($product)) ? $product->$description : ''}}</textarea>--}}

{{--                                        @error($description)--}}
{{--                                        <div class="alert alert-danger">{{$message}}</div>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}

{{--                                @endforeach--}}
{{--                            </div>--}}

{{--                            <label for="price" class="text-primary">Price</label>--}}
{{--                            <input type="number" class="form-control" name="price" @if(isset($product)) value="{{$product->price}}" @endif><br>--}}

{{--                            @error('price')--}}
{{--                            <div class="alert alert-danger">{{$message}}</div>--}}
{{--                            @enderror--}}

{{--                            <label class="text-primary">Parent category</label>--}}
{{--                            <select name="category_id" class="selectpicker form-control" data-style="select-with-transition" title="Choose parent category" data-live-search="true">--}}
{{--                                <option @if(isset($product)) selected value="{{$product->parent['item']}}" @endif>{{$product->parent['title'] ?? ''}}</option>--}}

{{--                                @foreach($categories as $item)--}}
{{--                                    @if(isset($product))--}}
{{--                                        @if($item->title != $product->parent['title'])--}}
{{--                                            <option value={{$item->id}}>{{$item->title}}</option>--}}
{{--                                        @endif--}}
{{--                                    @else--}}
{{--                                        <option value={{$item->id}}>{{$item->title}}</option>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            </select><br>--}}

{{--                            @error('category_id')--}}
{{--                            <div class="alert alert-danger">{{$message}}</div>--}}
{{--                            @enderror--}}

{{--                            <div class="card-footer ">--}}
{{--                                <input type="submit" class="btn btn-fill btn-rose col-auto mt-5" value="Submit">--}}
{{--                                <a href="{{route('product.index')}}" class="btn mt-5" style="border-color: black">Cancel</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--@endsection--}}

{{--@push('script')--}}
{{--    <script>--}}

{{--        let item = document.querySelectorAll('[id^="language"]');--}}
{{--        console.log(item);--}}

{{--        for (let i=0; i<item.length; ++i){--}}
{{--            ClassicEditor--}}
{{--                .create(item[i], {--}}
{{--                    removePlugins: ["EasyImage", "ImageUpload", "MediaEmbed"],--}}
{{--                })--}}

{{--                .catch(error => {--}}
{{--                    console.error(error);--}}
{{--                });--}}
{{--        }--}}

{{--    </script>--}}

{{--@endpush--}}



