<?php

namespace App\View\Components\Utils\Forms;

use Illuminate\View\Component;

class FormRowColor extends Component
{
    public $id;
    public $name;
    public $label;
    public $required;
    public $value;
    public $icon;

    /**
     *  Create a new component instance.
     *
     *  @param string $id
     *  @param string $label
     *  @param string $name
     *  @param false|bool $required
     *  @param null|string $value
     *  @param null|string $icon
     *  @return void
     */
    public function __construct(string $id, string $label, string $name, bool $required = false, string $value = null, string $icon = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->required = $required;
        $this->value = $value;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utils.forms.form-row-color');
    }
}
