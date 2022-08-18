<!-- Modal Edit User -->
<div class="modal fade" id="editUser{{ $user->id }}" role="dialogdata-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addUserLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('users.update', $user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $user->name }}" aria-describedby="" placeholder="Name" required>
                                    @error('name')
                                        <div class="alert alert-danger">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label for="" class="form-label">Role</label>
                                    <select name="is_admin" class="form-control form-select" id="" required>
                                        <option value="1" {{ ($user->is_admin == 1) ? 'selected' : ''}} >Admin</option>
                                        <option value="2" {{ ($user->is_admin == 2) ? 'selected' : ''}}>Cashire</option>
                                    </select>
                                    @error('is_admin')
                                        <div class="alert alert-danger">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email
                            address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Email Address" required>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}
                            </div>
                        @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{ $user->password }}"
                            placeholder="Password" readonly>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}
                            </div>
                        @enderror
                    </div> --}}
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning btn-block"><i class="fas fa-save"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
