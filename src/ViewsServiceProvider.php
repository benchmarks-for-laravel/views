<?php

namespace BenchmarksForLaravel\Views;

use Illuminate\Support\ServiceProvider;
use function BenchmarksForLaravel\Toolbox\manager;

class ViewsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        manager()->addBenchmark(ViewsBenchmark::class);
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'benchmarks-for-laravel-views');
    }
}
