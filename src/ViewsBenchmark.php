<?php

namespace BenchmarksForLaravel\Views;

use BenchmarksForLaravel\Toolbox\Benchmark\Benchmark;
use BenchmarksForLaravel\Toolbox\Benchmark\UpdateType;
use Closure;
use Illuminate\Support\Benchmark as SupportBenchmark;
use Illuminate\Support\Facades\Artisan;

class ViewsBenchmark extends Benchmark
{
    public function getSlug(): string
    {
        return 'benchmarks-for-laravel/views';
    }

    public function run(Closure $onUpdate): void
    {
        $onUpdate(
            $this->update(
                UpdateType::Info,
                description: 'Benchmarking view engine...',
            )
        );

        Artisan::call('view:clear');

        $this->welcome($onUpdate);
        $this->accounts($onUpdate);

        $onUpdate($this->update(UpdateType::Done));
    }

    private function welcome(Closure $onUpdate): void
    {
        $group = '1. Welcome page with layout component';

        $onUpdate(
            $this->update(
                type: UpdateType::Measurement,
                group: $group,
                description: '- Warming',
                measurement: SupportBenchmark::measure(
                    benchmarkables: fn() => view('benchmarks-for-laravel-views::welcome')->render()
                ),
            ),
        );

        $onUpdate(
            $this->update(
                type: UpdateType::Measurement,
                group: $group,
                description: '- Measuring',
                measurement: SupportBenchmark::measure(
                    benchmarkables: fn() => view('benchmarks-for-laravel-views::welcome')->render(),
                    iterations: 10,
                ),
            ),
        );
    }

    private function accounts(Closure $onUpdate): void
    {
        $group = '2. Account list (1000 avatars) with layout component';

        $onUpdate(
            $this->update(
                type: UpdateType::Measurement,
                group: $group,
                description: '- Warming',
                measurement: SupportBenchmark::measure(
                    benchmarkables: fn() => view('benchmarks-for-laravel-views::accounts')->render(),
                ),
            ),
        );

        $onUpdate(
            $this->update(
                type: UpdateType::Measurement,
                group: $group,
                description: '- Measuring',
                measurement: SupportBenchmark::measure(
                    benchmarkables: fn() => view('benchmarks-for-laravel-views::accounts')->render(),
                    iterations: 10,
                ),
            ),
        );
    }
}
