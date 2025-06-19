<?php

namespace App\Livewire;

use Livewire\Component;

class EditableTable extends Component
{
    public $rows = [];
    public $columns = [];

    public function mount($initialRows = [], $columns = [])
    {
        $this->rows = $initialRows;
        $this->columns = $columns;
    }

    public function addRow()
    {
        $newRow = [];
        foreach ($this->columns as $column) {
            $newRow[$column['field']] = '';
        }
        $newRow['editing'] = true;
        $this->rows[] = $newRow;
    }

    public function editRow($index)
    {
        $this->rows[$index]['editing'] = true;
    }

    public function saveRow($index)
    {
        $this->rows[$index]['editing'] = false;
    }

    public function deleteRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows); // Reindex array
    }

    public function render()
    {
        return view('livewire.editable-table');
    }
}

