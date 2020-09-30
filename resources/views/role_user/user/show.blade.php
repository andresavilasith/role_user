@extends('layouts.template')
@section('title')
| {{$user->name}}
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-3">
            <div class="card">
                @include('role_user.custom.message')
                <div class="card-header">
                    <h2>{{$user->name}} details</h2>
                </div>
                
                <div class="card-body">
                    <div class="container">
                        <div class="form-group">
                            <input disabled type="text" class="form-control" id="name" name="name" placeholder="name" value="{!! old('name',$user->name) !!}" required>
                        </div>

                        <div class="form-group">
                            <input disabled type="email" class="form-control" id="email" name="email" placeholder="email" value="{!! old('email',$user->email) !!}" required>
                        </div>

                        <div class="form-group">
                            <select name="roles" id="roles" disabled class="form-control">
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

                        <a href="{{route('user.index')}}" class="btn btn-primary btn-sm">
                            <i class="fas fa-arrow-circle-left"></i>
                        </a>

                        @can('update',[$user,['user.edit','userown.edit']])
                        <a href="{{route('user.edit',$user->id)}}" class="btn btn-success btn-sm">
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