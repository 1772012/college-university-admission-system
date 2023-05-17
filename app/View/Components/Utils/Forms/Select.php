<?php

namespace App\View\Components\Utils\Forms;

use Illuminate\View\Component;

class Select extends Component
{
    public $id;
    public $name;
    public $label;
    public $required;
    public $value;
    public $placeholder;
    public $list;
    public $icon;
    public $dataSource;

    /**
     *  Create a new component instance.
     *
     *  @param string $id
     *  @param null|string $label
     *  @param string $name
     *  @param false|bool $required
     *  @param null|string $value
     *  @param null|string $placeholder
     *  @param null|mixed $list
     *  @param $dataSource
     *  @param null|string $icon
     *  @return void
     */
    public function __construct(string $id, string $label = null, string $name, bool $required = false, string $value = null, string $placeholder = null, $list = null, string $icon = null, $dataSource = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->required = $required;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->list = $list;
        $this->icon = $icon;
        $this->dataSource = $dataSource;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utils.forms.select');
    }
}
