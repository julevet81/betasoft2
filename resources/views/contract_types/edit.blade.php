<!-- Modal -->
<div class="modal fade" id="edit{{ $contractType->id }}" tabindex="-1" permission="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" permission="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Contract Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('contracts.update', $contractType->id) }}" method="post">
                @csrf
                @method('patch')
                <div class="modal-body">
                    <label for="exampleInputPassword1">Contract Type Name</label>
                    <input type="hidden" name="id" value="{{ $contractType->id }}">
                    <input type="text" name="name" value="{{ $contractType->name }}" class="form-control">
                </div>
                <div class="modal-body">
                    <label for="exampleInputPassword1">Contract Type Description</label>
                    <textarea name="description" class="form-control">{{ $contractType->description }}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
