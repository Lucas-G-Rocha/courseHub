<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CourseCard extends Component
{

    public $curso;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($curso)
    {
        $this->curso = $curso;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.course-card');
    }
}
