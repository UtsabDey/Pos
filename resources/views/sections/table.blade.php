<table class="table table-bordered table-stripped table-hover" width="100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Section Name</th>
            <th>Section Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($sections as $key => $section)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $section->section_name }}</td>
                <td>{{ $section->status == 1 ? 'Enable' : 'Disabled' }}</td>
                <td>
                    <div class="btn-group">
                        <a href="#editSection" data-bs-toggle="modal" wire:click.prevent="editSection({{ $section->id }})" class="btn btn-info btn-sm me-2"><i class="fas fa-edit me-1"></i> Edit</a>
                        <a href="#" wire:click.prevent="ConfirmDelete({{ $section->id }}, '{{ $section->section_name }}')" class="btn btn-danger btn-sm"><i class="fas fa-trash me-1"></i> Delete</a>
                    </div>
                </td>
            </tr>
            @include('sections.editmodal')
        @empty
            <h4 class="text-center">No Data</h4>
        @endforelse
    </tbody>
</table>
