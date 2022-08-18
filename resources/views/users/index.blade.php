@extends('layouts.app')
@section('title', 'Users')
@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                User List
                                <a href="#" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
                                    data-bs-target="#addUser"><i class="fas fa-plus me-2"></i>Add User</a>
                            </h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered table-hover table-start" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->is_admin == 1 ? 'Admin' : 'Cashire' }}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#editUser{{ $user->id }}"
                                                        class="btn  btn-sm btn-info me-2"><i
                                                            class="fas fa-edit me-1"></i>Edit</a>
                                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteUser{{ $user->id }}"><i
                                                            class="fas fa-trash me-1"></i>Delete</a>
                                                </div>
                                            </td>
                                        </tr>
                                        @include('users.editmodal')
                                        @include('users.deletemodal')
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                            {{-- {{ $users->links() }} --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Search User</h4>
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('users.addmodal')
@endsection
