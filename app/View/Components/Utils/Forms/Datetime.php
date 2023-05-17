<?php

namespace App\View\Components\Utils\Forms;

use Illuminate\View\Component;

class Datetime extends Component
{
    public $id;
    public $name;
    public $label;
    public $required;
    public $value;
    public $size;
    public $placeholder;

    /**
     *  Create a new component instance.
     *
     *  @param string $id
     *  @param null|string $label
     *  @param string $name
     *  @param false|bool $required
     *  @param null|string $value
     *  @param null|string $size
     *  @param null|string $placeholder
     *  @return void
     */
    public function __construct(string $id, string $label = null, string $name, bool $required = false, string $value = null, string $size = null, string $placeholder = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->required = $required;
        $this->value = $value;
        $this->size = $size;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utils.forms.datetime');
    }
}
