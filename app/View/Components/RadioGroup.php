<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;
use PhpParser\Node\Expr\Cast\Array_;

class RadioGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public array $options,
        public ?bool $allOption = true
    )
    {
        //
    }

    public function optionWithLabels(): array
    {
        $isList = array_values($this->options) === $this->options;
        return $isList ? array_combine($this->options, $this->options) : $this->options;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.radio-group');
    }
}
