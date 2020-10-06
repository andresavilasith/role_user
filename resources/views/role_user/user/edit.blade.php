@extends('layouts.template')
@section('title')
| Edit {{$user->name}}
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            @include('role_user.custom.message')
            <div class="card">
                <div class="card-header">
                    <h2>Edit {{$user->name}}</h2>
                </div>


                <div class="card-body">
                    <form action="{{route('user.update',$user)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="container">
                            <h3>Required Data</h3>
                            <form>


                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{!! old('name',$user->name) !!}" required>
                                </div>


                                <div class="form-group">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="email" value="{!! old('email',$user->email) !!}" required>
                                </div>



                                <div class="form-group">
                                    <select name="roles" id="roles" class="form-control">
                                        @foreach($roles as $role)
                                        <option value="{!! $role->id !!}" @isset($user->roles[0]->name)
                                            @if($role->name==$user->roles[0]->name)
                                            selected
                                            @endif
                                            @endisset
                                            >
                                            {!! $role->name !!}
                                        </option>
                                        @endforeach
                                    </select>
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