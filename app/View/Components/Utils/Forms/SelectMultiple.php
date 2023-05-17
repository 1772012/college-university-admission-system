<?php

namespace App\View\Components\Utils\Forms;

use Illuminate\View\Component;

class SelectMultiple extends Component
{
    public $id;
    public $name;
    public $label;
    public $required;
    public $value;
    public $list;
    public $icon;
    public $dataSource;

    /**
     *  Create a new component instance.
     *
     *  @param string $id
     *  @param string $label
     *  @param string $name
     *  @param bool $required
     *  @param null|array $value
     *  @param $list
     *  @param $dataSource
     *  @param null|string $icon
     *  @return void
     */
    public function __construct(string $id, string $label, string $name, bool $required = false, array $value = null, $list, string $icon = null, $dataSource = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->required = $required;
        $this->value = $value;
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
        return view('components.utils.forms.select-multiple');
    }
}
