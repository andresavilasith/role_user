@extends('layouts.template')
@section('title')
| {!! $role->name !!}
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            <div class="card">
                @include('role_user.custom.message')
                <div class="card-header">
                    <h2>{!! $role->name !!} details</h2>
                </div>


                <div class="card-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{!! old('name',$role->name) !!}" required>
                    </div>


                    <div class="form-group">
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" value="{!! old('slug',$role->slug) !!}" required>
                    </div>


                    <div class="form-group">
                        <textarea name="description" id="description" class="form-control" placeholder="Description">{!! old('description',$role->description) !!}</textarea>
                    </div>

                    <hr>
                    <h3>Full Access</h3>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="fullaccessyes" name="full_access" class="custom-control-input" value="yes" @if($role['full_access']=='yes' ) checked @elseif(old('full_access')=='yes' ) checked @endif>



                        <label class="custom-control-label" for="fullaccessyes">Yes</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input type="radio" id="fullaccessno" name="full_access" class="custom-control-input" value="no" @if($role['full_access']=='no' ) checked @elseif(old('full_access')=='no' ) checked @endif>
                        <label class="custom-control-label" for="fullaccessno">No</label>
                    </div>

                    <hr>

                    <div class="col-12">

                        <nav>
                            <div class="nav nav-tabs" id="nav-tab_category_permission" role="tablist">
                                <a class="nav-item btn btn btn-dark active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="presentation" aria-controls="nav-home" aria-selected="true">{{$role->name}}</a>
                            </div>
                        </nav>


                        <div class="tab-content mt-3" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                                <p>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            @foreach($categories as $category)


                                            <br>
                                            <div class="badge badge-primary">
                                                {{$category->name}}
                                            </div>


                                            @foreach($category->permissions as $permission)


                                            @if(in_array("$permission->id",$permission_role))

                                            <span class="badge badge-pill badge-success">{!! $permission->name !!}</span>



                                            @endif

                                            @endforeach

                                            @endforeach
                                        </li>

                                    </ul>

                                </p>
                            </div>

                        </div>

                        <a href="{{route('role.index')}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-arrow-circle-left"></i>
                        </a>

                        @can('haveaccess','role.edit')
                        <a href="{{route('role.edit',$role->id)}}" class="btn btn-success btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection