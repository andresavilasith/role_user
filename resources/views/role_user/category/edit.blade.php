@extends('layouts.template')
@section('title')
| Edit {{$category->name}}
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            @include('role_user.custom.message')
            <div class="card">
                <div class="card-header">
                    <h2>Edit {{$category->name}}</h2>
                </div>


                <div class="card-body">
                    <form action="{{route('category.update',$category)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="container">
                            <h3>Required Data</h3>
                            <form>


                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{!! old('name',$category->name) !!}" required>
                                </div>


                                
                                <div class="form-group">
                                        <textarea name="description" id="description" class="form-control" placeholder="Description" >{!! old('description',$category->description) !!}</textarea>
                                </div>

                                <hr>

                                <input type="submit" class="btn btn-primary" value="Submit">
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection