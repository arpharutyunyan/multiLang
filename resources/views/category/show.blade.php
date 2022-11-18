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
                            <p><b class="form-control">{{$category->title}}</b></p>
                        </div>

                        @if(isset($category->parent['title']))
                            <div class="form-group">
                                <label class="bmd-label-floating">Parent category</label>
                                <p><b class="form-control">{{$category->parent['title']}}</b></p>
                            </div>
                        @endif

                        <div class="form-group">
                            <label>Created At</label>
                            <p><b class="form-control">{{$category->created_at}}</b></p>
                        </div>
                        <div class="form-group">
                            <label>Updated At</label>
                            <p><b class="form-control">{{$category->updated_at}}</b></p>
                        </div>
                        <a href="{{route('category.index')}}" class="btn btn-fill btn-rose">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
