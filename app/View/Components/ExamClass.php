<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ExamClass extends Component
{
    public $name;
    public $url;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $url)
    {
        $this->name = $name;
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.exam-class');
    }
}
