<?php

namespace App\View\Components\Utils\Forms;

use Illuminate\View\Component;

class RadioItem extends Component
{
    public $id;
    public $name;
    public $title;
    public $type;
    public $value;
    public $required;
    public $checked;
    public $disabled;
    public $inline;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $id = null,
        $name = null,
        $title = null,
        $type = 'primary',
        $value = null,
        $required = 0,
        $checked = 0,
        $disabled = 0,
        $inline = 0
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
        $this->type = 'icheck-' . $type;
        $this->value = $value;
        $this->required = $required;
        $this->checked = $checked;
        $this->disabled = $disabled;
        $this->inline = $inline;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utils.forms.radio-item');
    }
}
