<div class="modal fade" id="addSection" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add New Section</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="store" method="post" enctype="multipart/form-data">
                    @csrf
                    @forelse ($addMore as $more)
                        <div class="row d-flex flex-row flex-wrap">
                            <div class="col-sm-9">
                                <label for="">Section Name</label>
                                <input type="text" name="section_name" id="section_name" class="form-control">
                                @error('section_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-1 me-3">
                                <label for="">Status</label>
                                <span> <input type="checkbox" name="status" id="status"></span>
                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-success" wire:ignore wire:click.prevent="AddMore">
                                    <i class="fas fa-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                    @empty
                    @endforelse
                </form>
            </div>
        </div>
    </div>
</div>
