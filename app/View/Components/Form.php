<?php

namespace App\View\Components;
use Illuminate\View\Component;

class Form extends Component
{
    public string $buttonText;
    public function __construct($buttonText = 'Отправить')
    {
        $this->buttonText = $buttonText;
    }

    public function render()
    {
        return view('components.form');
    }
}