<?php

namespace BenchmarksForLaravel\Views;

use Illuminate\Support\ServiceProvider;
use function BenchmarksForLaravel\Toolbox\manager;

class ViewsServiceProvider extends ServiceProvider
{
    public static string $prefix = 'benchmarks-for-laravel-views';

    /**
     * Number of times to run each benchmark
     */
    public static int $benchmarkIterations = 25;

    /**
     * Number of times to repeat elements inside a view
     */
    public static int $loopIterations = 2500;

    public function register(): void
    {
        manager()->addBenchmark(ViewsBenchmark::class);
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', static::$prefix);
    }
}
