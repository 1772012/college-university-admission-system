<?php

namespace App\View\Components\Utils\Content;

use Illuminate\View\Component;

class Title extends Component
{
    public $text;
    public $breadcrumb;

    /**
     *  Create a new component instance.
     *
     *  @param string $text
     *  @param mixed $breadcrumb
     *  @return void
     */
    public function __construct(string $text, $breadcrumb = null)
    {
        $this->text = $text;
        $this->breadcrumb = $breadcrumb;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utils.content.title');
    }
}
