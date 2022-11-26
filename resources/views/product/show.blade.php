@extends('layouts.auth')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 ml-auto mr-auto">

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
                        <div class="form-group" >
                            <label class="bmd-label-floating">Title ({{$code}})</label>
                            <p><b class="form-control">{{$product->title}}</b></p>
                        </div>

                        <div class="form-group" >
                            <label>Description ({{$code}})</label>
                            <p><b><?=$product->description?></b></p>
                        </div>

                        <div class="form-group">
                            <label class="bmd-label-floating">Parent category</label>
                            <p><b class="form-control">{{$product->parent['title']}}</b></p>
                        </div>

                        <div class="form-group">
                            <label>Price</label>
                            <p><b>{{$product->price}}</b></p>
                        </div>

                        <div class="form-group">
                            <label>Created At</label>
                            <p><b class="form-control">{{$product->created_at}}</b></p>
                        </div>
                        <div class="form-group">
                            <label>Updated At</label>
                            <p><b class="form-control">{{$product->updated_at}}</b></p>
                        </div>
                        <a href="{{route('product.index')}}" class="btn btn-fill btn-rose">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
