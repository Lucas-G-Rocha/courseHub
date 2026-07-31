<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;

class ConfirmationDelete extends Component
{

    public $id;
    public $ariaLabelId;
    public $title;
    public $dados;
    public $formRoute;
    public $description;
    public $dependanceDescription;
    public $countDependances;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $title, $ariaLabelId, $dados, $formRoute, $description, $dependanceDescription, $countDependances)
    {

        $this->id = $id;
        $this->title = $title;
        $this->ariaLabelId = $ariaLabelId;
        $this->dados = $dados;
        $this->formRoute = $formRoute;
        $this->description = $description;
        $this->dependanceDescription = $dependanceDescription;
        $this->countDependances = $countDependances;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.confirmation-delete');
    }
}
