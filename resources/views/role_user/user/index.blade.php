@extends('layouts.template')
@section('title')
| Users
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 mt-3">
        <div class="card">
        @include('role_user.custom.message')
            <div class="card-header">
                <h2 class="text-center">
                    List Of users
                </h2> 
            </div>
            <div class="card-body">
                <table id="datablegeneral" class="table table-bordered table-striped dt-responsive">
                    <thead>
                        <tr class="text-center">
                            <th>id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role(s)</th>
                            @can('haveaccess','user.show')
                            <th>Show</th>
                            @endcan
                            @can('haveaccess','user.edit')
                            <th>Edit</th>
                            @endcan
                            @can('haveaccess','user.destroy')
                            <th>Delete</th>
                            @endcan

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="text-center">
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}
                            </td>
                            <td>{{count($user->roles)>=1 ? $user->roles[0]->name : 'No hay roles asignados'}}</td>
                            @can('view',[$user,['user.show','userown.show']])
                            <td>
                                <a href="{{route('user.show',$user->id)}}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                            @endcan
                            @can('update',[$user,['user.edit','userown.edit']])
                            <td>
                                <a href="{{route('user.edit',$user->id)}}" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            @endcan
                            @can('haveaccess','user.destroy')
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $user->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete {{ $user->name }} ?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Delete {{$user->name}} and permissions
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form action="{{route('user.destroy',$user)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        @endsection
    </div>
</div>