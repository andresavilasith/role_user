@extends('layouts.template')
@section('title')
| Permissions
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 mt-3">
        <div class="card">
            @include('role_user.custom.message')
            <div class="card-header">
                <h2 class="text-center">
                    List of permissions
                </h2>
                <div>
                    @can('haveaccess','permission.create')
                    <a href="{{route('permission.create')}}" class="btn btn-primary">Create</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <table id="datablegeneral" class="table table-bordered table-striped dt-responsive">
                    <thead>
                        <tr class="text-center">
                            <th>id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>description</th>
                            @can('haveaccess','permission.show')
                            <th>Show</th>
                            @endcan
                            @can('haveaccess','permission.edit')
                            <th>Edit</th>
                            @endcan
                            @can('haveaccess','permission.destroy')
                            <th>Delete</th>
                            @endcan

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                        <tr class="text-center">
                            <td>{{$permission->id}}</td>
                            <td>{{$permission->name}}</td>
                            <td>{{$permission->slug}}</td>
                            <td>{{$permission->description}}
                                @can('haveaccess','permission.show')
                            </td>
                            <td>
                                <a href="{{route('permission.show',$permission->id)}}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                            @endcan

                            @can('haveaccess','permission.edit')
                            <td>
                                <a href="{{route('permission.edit',$permission->id)}}" class="btn btn-success btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            @endcan
                            @can('haveaccess','permission.destroy')
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{ $permission->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $permission->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete {{ $permission->name }} ?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Delete {{$permission->name}} and permissions
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <form action="{{route('permission.destroy',$permission)}}" method="post">
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