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
                                        Nothing to Show
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

    <!-- Modal Add New User -->
    <div class="modal fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addUserLabel">Add User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="post">
                        @csrf
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            aria-describedby="" placeholder="Name">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Role</label>
                                        <select name="is_admin" class="form-control" id="" required>
                                            <option value="">Select User Role</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Cashire</option>
                                        </select>
                                        @error('is_admin')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                aria-describedby="emailHelp" placeholder="Email Address" required>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- <div class="mb-3">
                            <label for="" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" aria-describedby=""
                                placeholder="Phone Number" pattern="[0]{1}[1]{1}[0-9]{9}" required>
                            @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" required>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                placeholder="Confirm Password" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
