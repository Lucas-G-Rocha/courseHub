<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProfessorCard extends Component
{

    public $professor;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($professor)
    {
        $this->professor = $professor;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.professor-card');
    }
}
