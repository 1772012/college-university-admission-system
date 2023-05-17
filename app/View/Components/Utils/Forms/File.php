<?php

namespace App\View\Components\Utils\Forms;

use Illuminate\View\Component;

class File extends Component
{
    public $id;
    public $name;
    public $label;
    public $required;
    public $accept;

    /**
     *  Create a new component instance.
     *
     *  @param string $id
     *  @param string $label
     *  @param string $name
     *  @param bool $required
     *  @param string $accept
     *  @return void
     */
    public function __construct(string $id, string $label, string $name, bool $required = false, string $accept)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->required = $required;
        $this->accept = $accept;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utils.forms.file');
    }
}
