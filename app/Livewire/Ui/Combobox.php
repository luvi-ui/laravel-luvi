<?php

namespace App\Livewire\Ui;

use Livewire\Attributes\Modelable;
use Livewire\Component;

class Combobox extends Component
{
    #[Modelable]
    public $value;

    public $model;

    public $searchable = [];

    public int $limit = 5;

    public $search = '';

    public $show = false;

    public $placeholder = '';

    public $selected;

    public $display = '';

    public $results = [];

    public function mount()
    {
        if ($this->value) {
            $result = $this->model::findOrFail($this->value);
            $this->selected = $result;
        }

        $this->results = collect([]);
    }

    public function updatedSearch($value)
    {
        $query = $this->model::query();

        foreach ($this->searchable as $search) {
            $query->where($search, 'like', "%$value%");
        }

        $this->results = $query->limit($this->limit)->get();
    }

    public function select($result)
    {
        $result = $this->results->find($result);

        $this->value = $result->id;
        $this->selected = $result;
        $this->show = false;
        $this->reset(['search', 'results']);
    }

    public function render()
    {
        return view('livewire.combobox.index');
    }
}
