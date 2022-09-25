<?php

namespace App\Http\Livewire;

use App\Models\Section as ModelsSection;
use Livewire\Component;

class Section extends Component
{
    public $addMore = [1];
    public $count = 0;
    public $section_name, $section_status, $edit_id;
    public $checked = [], $selectAll = false;

    public function AddMore()
    {
        $countable = $this->count++;
        if ($countable < 4) {
            $this->addMore[] = count($this->addMore) + 1;
        }
    }

    public function Remove($index)
    {
        $this->count--;
        unset($this->addMore[$index]);
    }

    protected $listeners = ['RecordDeleted'];

    public function store()
    {
        foreach ($this->section_name as $key => $value) {
            ModelsSection::create([
                'section_name' => $this->section_name[$key],
                'status' => $this->section_status[$key] ?? 0,
            ]);
        }
        $this->FormReset();
        $this->SwalMessage('Section created successfully.');
    }

    public function editSection($section_id)
    {
        $this->edit_id = $section_id;
        $section = ModelsSection::findOrFail($section_id);
        // dd($section);
        $this->section_name = $section->section_name;
        $this->section_status = $section->status;
    }

    public function update($section_id)
    {
        ModelsSection::updateOrCreate(['id' => $this->edit_id], [
            'section_name' => $this->section_name,
            'status' => $this->section_status ?? 0
        ]);

        $this->FormReset();
        $this->SwalMessage('Section Updated successfully.');
    }

    public function isChecked($section_id)
    {
        return $this->checked && $this->selectAll ? in_array($section_id, $this->checked) : in_array($section_id, $this->checked);
    }

    public function updatedSelectAll($value_in_array)
    {
        $value_in_array ? $this->checked = ModelsSection::pluck('id') : $this->checked = []; 
    }

    public function ConfirmBulkDelete()
    {
        $this->dispatchBrowserEvent('Swal:DeletedRecord', [
            'title' => 'Are you sure you want to delete All?',
            'id' => $this->checked,
        ]);
    }

    public function ConfirmDelete($section_id, $section_name)
    {
        // dd($section_id, $section_name);
        $this->dispatchBrowserEvent('Swal:DeletedRecord', [
            'title' => 'Are you sure you want to delete <span class="text-danger">' .$section_name. '</span>',
            'id' => $section_id,
        ]);
    }

    public function RecordDeleted($section_id)
    {
        if ($this->checked) {
            ModelsSection::whereIn('id', $this->checked)->delete();
            $this->checked = []; 
            $this->selectAll = false;
        } else {
            $section = ModelsSection::find($section_id);
            $section->delete();
        }
    }

    public function FormReset()
    {
        $this->section_name = '';
        $this->section_status = '';
        $this->addMore = [1];

        $this->dispatchBrowserEvent('closeModel');
    }

    public function SwalMessage($message)
    {
        $this->dispatchBrowserEvent('MSGSuccessfull', [
            'title' => $message,
        ]);
    }

    public function render()
    {
        $data['sections'] = ModelsSection::all();
        return view('livewire.section', $data);
    }
}
