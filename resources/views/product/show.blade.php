@extends('layouts.auth')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="mt-auto ml-auto mr-auto ">
                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">list</i>
                            </div>
                            <h4 class="card-title">View Record</h4>
                        </div>
                        <div class="card-body ">
                            @php
                                $code = app()->getLocale()
                            @endphp

                            <div class="form-group mt-2" >
                                <label class="bmd-label-floating mt-2">Title ({{$code}})</label>
                                <b class="form-control mt-auto">{{$product['title']}}</b>
                            </div>

                            <div class="form-group mt-2" >
                                <label class="bmd-label-floating mt-2">Description ({{$code}})</label>
                                <b class="form-control mt-auto"><?=$product->description?></b>
                            </div>

                            <div class="form-group mt-2">
                                <label class="bmd-label-floating">Parent category</label>
                                <b class="form-control">{{$product->parent['title']}}</b>
                            </div>

                            <div class="form-group mt-2">
                                <label class="bmd-label-floating">Manufacturer category</label>
                                <b class="form-control">{{$product->manufacturer['title']}}</b>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="mt-auto ml-auto mr-auto">
                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">image</i>
                            </div>
                            <h4 class="card-title">Images</h4>

                        </div>
                        <div class="card-body mt-auto ml-auto mr-auto">
                            @if(count($files) === 0)
                                <strong>No images</strong>
                            @endif
                            <div class="row">
                                @for($i=0; $i < count($files); ++$i)
                                    <div class="col">
                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                <a class="thumbnail" href="@if(isset($product)) {{asset('storage/products/'.$files[$i]['name'])}} @endif" target="_blank">
                                                    <img src="@if(isset($product)) {{asset('storage/products/'.$files[$i]['name'])}} @endif " alt="...">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">

                <div class="mt-auto ml-auto mr-auto ">
                    <div class="card">
                        <div class="card-header card-header-rose card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">details</i>
                            </div>
                            <h4 class="card-title">Details</h4>
                        </div>

                        <div class="card-body ">
                            @foreach($details as $item => $value)
                                @if($item !== 'manufacturer_id' and $item !== 'id' and $value != Null)
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">{{$item}}</label>
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <b class="form-control">{{$value}}</b>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-end">
            <div class="col-auto col-sm-auto">
                <a href="{{route('product.index')}}" class="btn btn-fill btn-rose">Back</a>
            </div>
        </div>
    </div>

@endsection
