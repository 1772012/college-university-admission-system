<?php

namespace App\View\Components\Utils\Forms;

use Illuminate\View\Component;

class CheckboxContainer extends Component
{
    public $id;
    public $title;
    public $help;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id = null, $title = null, $help = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->help = $help;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utils.forms.checkbox-container');
    }
}
