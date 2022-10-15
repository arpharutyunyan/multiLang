@extends('layouts.app')

@section('content')

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>id</label>
                        <p><b><?php echo $categories->id; ?></b></p>
                    </div>
                    <div class="form-group">
                        @foreach(config('translatable.locales')::all() as $locales)
                            @php
                                $title = 'title_'.$locales['code']
                            @endphp
                        <label>Title.{{$locales['code']}}</label>
                        <p><b><?php echo $categories->$title; ?></b></p>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label>Parent id</label>
                        <p><b><?php echo $categories->parent_id; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Created At</label>
                        <p><b><?php echo $categories->created_at; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Updated At</label>
                        <p><b><?php echo $categories->updated_at; ?></b></p>
                    </div>
                    <p><a href={{route('category.index')}} class="btn col-auto bg-dark text-white">Back</a></p>
                </div>
            </div>
        </div>
    </div>

@endsection
