@extends('layouts.auth')

@section('content')

    <div class="content">
        <div class="container-fluid">

            <h3>Manage Listings</h3>
            <br>
            <div class="row">
                <div class="col-md-4 ml-auto mr-auto">
                    <div class="card card-product">
                        <div class="card-header card-header-image" data-header-animation="true">
                            <a href="{{route('category.index')}}">
                                <img class="img" src="{{asset('assets/img/category.jpg')}}">
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="card-actions text-center">
                                <button type="button" class="btn btn-danger btn-link fix-broken-card">
                                    <i class="material-icons">build</i> Fix Header!
                                </button>
                                <button type="button" class="btn btn-danger btn-link" rel="tooltip" data-placement="bottom" title="Add">
                                    <a href="{{route('category.create')}}"> <i class="material-icons">add</i>Add category</a>
                                </button>
                            </div>
                            <h4 class="card-title">
                                <a href="{{route('category.index')}}">Category</a>
                            </h4>
                            <div class="card-description">
                                A product category is a group of similar products that share related characteristics.
                                Product category marketing focuses on promoting certain categories to meet consumer expectations.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 ml-auto mr-auto">
                    <div class="card card-product">
                        <div class="card-header card-header-image" data-header-animation="true">
                            <a href="{{route('product.create')}}">
                                <img class="img" src="{{asset('assets/img/product.jpg')}}">
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="card-actions text-center">
                                <button type="button" class="btn btn-danger btn-link fix-broken-card">
                                    <i class="material-icons">build</i> Fix Header!
                                </button>
                                <button type="button" class="btn btn-danger btn-link" rel="tooltip" data-placement="bottom" title="Add">
                                    <a href="{{route('product.create')}}"> <i class="material-icons">add</i>Add product</a>
                                </button>
                            </div>
                            <h4 class="card-title">
                                <a href="{{route('product.index')}}">Product</a>
                            </h4>
                            <div class="card-description">
                                A product category is a group of similar products that share related characteristics.
                                Product category marketing focuses on promoting certain categories to meet consumer expectations.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
