@extends('layouts.template')
@section('title')
| {{$permission->name}}
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            <div class="card">
                @include('role_user.custom.message')
                <div class="card-header">
                    <h2>{{ $permission->name }} details</h2>
                </div>


                <div class="card-body">
                    <form method="post">
                        <div class="container">
                            <form>

                                <div class="form-group">
                                    <select name="category_id" id="category_id" class="form-control" disabled>
                                        @foreach($categories as $category)
                                        <option value="{!! $category->id !!}" @isset($permission->category->name)
                                            @if($category->id==$permission->category->id)
                                            selected
                                            @endif
                                            @endisset
                                            >
                                            {!! $category->name !!}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>




                                <div class="form-group">
                                    <input disabled type="text" class="form-control" id="name" name="name" placeholder="name" value="{!! old('name',$permission->name) !!}" required>
                                </div>


                                <div class="form-group">
                                    <input disabled type="text" class="form-control" id="slug" name="slug" placeholder="slug" value="{!! old('slug',$permission->slug) !!}" required>
                                </div>



                                <div class="form-group">
                                    <textarea name="description" id="description" class="form-control" placeholder="Description" disabled>{!! old('description',$permission->description) !!}</textarea>
                                </div>




                                <hr>

                                <a href="{{route('permission.index')}}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-arrow-circle-left"></i>
                                </a>

                                @can('haveaccess','permission.edit')
                                <a href="{{route('permission.edit',$permission->id)}}" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                @endcan

                            </form>


                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection