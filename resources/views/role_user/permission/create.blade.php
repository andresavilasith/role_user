@extends('layouts.template')
@section('title')
| Create Permission
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            @include('role_user.custom.message')
            <div class="card">
                <div class="card-header">
                    <h2>Create permission</h2>
                </div>


                <div class="card-body">
                    <form action="{{route('permission.store')}}" method="post">
                        @csrf
                        @method('POST')
                        <div class="container">
                            <h3>Required Data</h3>
                            <form>

                                <div class="form-group">
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option>Select category</option>
                                        @foreach($categories as $category)
                                        <option value="{!! $category->id !!}">
                                            {!! $category->name !!}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{!! old('name') !!}" required>
                                </div>

                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>Alert!</strong> Be careful with the slug this may affect the functionality of the application it's only used to create or modify modules .
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" value="{!! old('slug') !!}" required>
                                </div>


                                <div class="form-group">
                                    <textarea name="description" id="description" class="form-control" placeholder="Description">{!! old('description') !!}</textarea>
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