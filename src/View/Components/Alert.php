<?php

namespace BenchmarksForLaravel\Views\View\Components;

use BenchmarksForLaravel\Views\ViewsServiceProvider;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public function __construct(
        public string $message,
        public string $title = 'Alert',
        public string $type = 'info',
    )
    {}

    public function render(): View
    {
        return view(ViewsServiceProvider::$prefix.'::components.alert');
    }
}
