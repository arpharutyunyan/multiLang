@extends('layouts.app')

@section('content')
   <div class="row justify-content-evenly mt-5">

        <div class="col-md-2 mb-5">
            <div class="card" style="width: 100%">
                <div class="card-body">
                    <a href="{{route('category.index')}}">Category</a>
                    <p>
                        Some quick example text to build on the card title and make up
                        the bulk of the card's content.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-5">
            <div class="card" style="width: 100%">
                <div class="card-body">
                    <a href="{{route('product.index')}}">Product</a>
                    <p class="card-text">
                        Some quick example text to build on the card title and make up
                        the bulk of the card's content.
                    </p>
                </div>
            </div>
        </div>

   </div>
@endsection
