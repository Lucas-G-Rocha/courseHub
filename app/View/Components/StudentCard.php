<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StudentCard extends Component
{

    public $aluno;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($aluno)
    {
        $this->aluno = $aluno;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.student-card');
    }
}
