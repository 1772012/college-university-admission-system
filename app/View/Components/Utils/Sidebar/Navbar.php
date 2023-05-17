<?php

namespace App\View\Components\Utils\Sidebar;

use Illuminate\View\Component;

class Navbar extends Component
{
    public $href;
    public $icon;
    public $title;
    public $isActive;

    /**
     *  Create a new component instance.
     *
     *  @param string $href
     *  @param string $icon
     *  @param string $title
     *  @param bool $isActive
     *  @return void
     */
    public function __construct(string $href, string $icon, string $title, bool $isActive = false)
    {
        $this->href = $href;
        $this->icon = $icon;
        $this->title = $title;
        $this->isActive = $isActive;
    }

    /**
     *  Get the view / contents that represent the component.
     *
     *  @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.utils.sidebar.navbar');
    }
}
