<div class="col-md-4 col-sm-4">
    @if (count($checked) > 1)
        <a href="#" class="btn btn-outline btn--sm" wire:click.prevent="ConfirmBulkDelete">
            ( {{ count($checked) }} Row is Selected to <b>Delete</b>)
        </a>
    @endif
</div><br>

<table class="table table-bordered table-stripped table-hover" width="100%">
    <thead>
        <tr>
            <th><input type="checkbox" wire:model="selectAll"> #</th>
            <th>Section Name</th>
            <th>Section Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($sections as $key => $section)
            <tr>
                <td><input type="checkbox" value="{{ $section->id }}" wire:model="checked"> {{ $key + 1 }}</td>
                <td>{{ $section->section_name }}</td>
                <td><label for=""
                        class="badge {{ $section->status == 1 ? 'bg-success' : 'bg-danger' }}">{{ $section->status == 1 ? 'Enabled' : 'Disabled' }}</label>
                </td>
                <td>
                    <div class="btn-group">
                        <a href="#editSection" data-bs-toggle="modal"
                            wire:click.prevent="editSection({{ $section->id }})" class="btn btn-info btn-sm me-2"><i
                                class="fas fa-edit me-1"></i> Edit</a>
                        @if (count($checked) < 2)
                            <a href="#"
                                wire:click.prevent="ConfirmDelete({{ $section->id }}, '{{ $section->section_name }}')"
                                class="btn btn-danger btn-sm"><i class="fas fa-trash me-1"></i> Delete</a>
                        @endif
                    </div>
                </td>
            </tr>
            @include('sections.editmodal')
        @empty
        @endforelse
    </tbody>
</table>
