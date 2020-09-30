@extends('layouts.template')
@section('title')
| Create role
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            <div class="card">
                @include('role_user.custom.message')
                <div class="card-header">
                    <h2>Create Role</h2>
                </div>


                <div class="card-body">
                    <form action="{{route('role.store')}}" method="post">
                        @csrf
                        @method('POST')
                        <div class="container">
                            <h3>Required Data</h3>




                            <div class="form-group">
                                <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{!! old('name') !!}" required>
                            </div>


                            <div class="form-group">
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" value="{!! old('slug') !!}" required>
                            </div>


                            <div class="form-group">
                                <textarea name="description" id="description" class="form-control" placeholder="Description">{!! old('description') !!}</textarea>
                            </div>

                            <hr>
                           
                            <h3>Full Access</h3>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="fullaccessyes" name="full_access" class="custom-control-input" value="yes" {!! old('full_access')=='yes' ? 'checked' :'' !!}>
                                <label class="custom-control-label" for="fullaccessyes">Yes</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="fullaccessno" name="full_access" class="custom-control-input" value="no" {!! old('full_access')=='no' ? 'checked' :'' !!} {!! old('full_access')===null ? 'checked' : '' !!}>
                                <label class="custom-control-label" for="fullaccessno">No</label>
                            </div>
                            <hr>

                            <div class="col-12">

                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab_category_permission" role="tablist">
                                        <a class="nav-item btn btn btn-dark active mr-3" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="presentation" aria-controls="nav-home" aria-selected="true">All categories and permits</a>
                                        @foreach($categories as $category)
                                        <a class="nav-link btn btn-outline-primary" id="nav-home-tab{{$category->id}}" data-toggle="tab" href="#nav-home{{$category->id}}" role="tab" aria-controls="nav-home{{$category->id}}" aria-selected="true">{{$category->name}}</a>
                                        @endforeach
                                    </div>
                                </nav>


                                <div class="tab-content mt-3 ml-3" id="nav-tabContent">
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



                                                    <span class="badge badge-pill badge-success">{!! $permission->name !!}</span>


                                                    @endforeach

                                                    @endforeach
                                                </li>

                                            </ul>

                                        </p>

                                    </div>


                                    @foreach($categories as $category)
                                    <div class="tab-pane fade show" id="nav-home{{$category->id}}" role="tabpanel" aria-labelledby="nav-home-tab{{$category->id}}">
                                        @foreach($category->permissions as $permission)

                                        <div class="custom-control custom-checkbox mt-3">
                                            <input type="checkbox" class="custom-control-input" id="permission_{!! $permission->id !!}" value="{!! $permission->id !!}" name="permission[]">
                                            <label class="custom-control-label" for="permission_{!! $permission->id !!}">
                                                {!! $permission->name !!}
                                                <em>({!! $permission->description !!})</em>

                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <hr>



                            <input type="submit" class="btn btn-primary" value="Submit">
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection