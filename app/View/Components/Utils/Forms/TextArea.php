<?php

namespace App\View\Components\Utils\Forms;

use Illuminate\View\Component;

class TextArea extends Component
{
    public $id;
    public $name;
    public $label;
    public $required;
    public $value;
    public $icon;
    public $cols;
    public $rows;

    /**
     *  Create a new component instance.
     *
     *  @param string $id
     *  @param null|string $label
     *  @param string $name
     *  @param bool $required
     *  @param null|string $value
     *  @param null|string $icon
     *  @param null|int $cols
     *  @param null|int $rows
     *  @return void
     */
    public function __construct(string $id, string $label = null, string $name, bool $required, string $value = null, string $icon = null, int $cols = null, int $rows = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->required = $required;
        $this->value = $value;
        $this->icon = $icon;
        $this->cols = $cols;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utils.forms.text-area');
    }
}
