<!-- Modal -->
<div class="modal fade" id="edit{{ $user->id }}" tabindex="-1" permission="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" permission="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('users.update', $user->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <label for="exampleInputPassword1">User Name</label>
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                </div>
                <div class="modal-body">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="form-control">
                </div>
                <div class="modal-body">
                    <label for="exampleInputPassword1">Phone</label>
                    <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                </div>
                <div class="modal-body">
                    <label for="exampleInputPassword1">Address</label>
                    <input type="text" name="address" value="{{ $user->address }}" class="form-control">
                </div>
                <div class="modal-body">
                    <label for="exampleInputPassword1">Image URL</label>
                    <input type="text" name="image" value="{{ $user->image }}" class="form-control">
                </div>
                <div class="modal-body">
                    <label for="exampleInputPassword1">Role</label>
                    <select name="role_name" class="form-control">
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->roles->contains('name', $role->name) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                
                <div class="modal-body">
                    <label for="exampleInputPassword1">Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
