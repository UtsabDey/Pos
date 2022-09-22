<div class="modal fade closeAdd" id="addSection" wire:ignore.self data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
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
                                <input type="text" wire:model="section_name.{{ $more }}" class="form-control">
                                @error('section_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-1 me-3" data-bs-toggle="tooltip" data-bs-placement="top" title="Status">
                                <label class="switch" style="margin-top: 1.7em !important;">
                                    <input type="checkbox" wire:model="section_status.{{ $more }}">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="col-sm-1 btn-group">
                                <button class="btn btn-success btn-sm me-1" wire:ignore wire:click.prevent="AddMore"
                                    style="margin-top: 22px;">
                                    <i class="fas fa-plus-circle"></i>
                                </button>
                                @if ($loop->index > 0)
                                    <button class="btn btn-danger btn-sm" wire:ignore
                                        wire:click.prevent="Remove({{ $loop->index }})" style="margin-top: 22px;">
                                        <i class="fas fa-plus-circle"></i>
                                    </button>
                                @endif
                            </div>
                        </div><br>
                    @empty
                    @endforelse
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block">Create Section</button>
                        <button type="button" class="btn btn-danger btn-block" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
