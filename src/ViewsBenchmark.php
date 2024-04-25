<?php

namespace BenchmarksForLaravel\Views;

use BenchmarksForLaravel\Toolbox\Benchmark\Benchmark;
use BenchmarksForLaravel\Toolbox\Benchmark\UpdateType;
use Closure;
use Illuminate\Support\Benchmark as SupportBenchmark;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\View;

class ViewsBenchmark extends Benchmark
{
    public function getSlug(): string
    {
        return 'benchmarks-for-laravel/views';
    }

    public function run(Closure $onUpdate): void
    {
        $this->welcome($onUpdate);
        $this->accounts($onUpdate);
        $this->messages($onUpdate);

        $this->clearCache();

        $onUpdate($this->update(UpdateType::Done));
    }

    private function welcome(Closure $onUpdate): void
    {
        $group = 'Welcome page in a single layout component';

        $onUpdate(
            $this->update(
                type: UpdateType::Measurement,
                group: $group,
                description: 'Without file cache',
                measurement: SupportBenchmark::measure(
                    benchmarkables: function() {
                        $this->clearCache();
                        $this->renderView('welcome');
                    },
                ),
            ),
        );

        // make sure view is cached
        $this->renderView('welcome');

        $onUpdate(
            $this->update(
                type: UpdateType::Measurement,
                group: $group,
                description: 'With file cache',
                measurement: SupportBenchmark::measure(
                    benchmarkables: fn() => $this->renderView('welcome'),
                    iterations: ViewsServiceProvider::$benchmarkIterations,
                ),
            ),
        );
    }

    private function accounts(Closure $onUpdate): void
    {
        $group = 'Account list ('.ViewsServiceProvider::$loopIterations.' anonymous components)';

        $onUpdate(
            $this->update(
                type: UpdateType::Measurement,
                group: $group,
                description: 'Without file cache',
                measurement: SupportBenchmark::measure(
                    benchmarkables: function() {
                        $this->clearCache();
                        $this->renderView('accounts');
                    },
                    iterations: ViewsServiceProvider::$benchmarkIterations,
                ),
            ),
        );

        // make sure view is cached
        $this->renderView('accounts');

        $onUpdate(
            $this->update(
                type: UpdateType::Measurement,
                group: $group,
                description: 'With file cache',
                measurement: SupportBenchmark::measure(
                    benchmarkables: fn() => $this->renderView('accounts'),
                    iterations: ViewsServiceProvider::$benchmarkIterations,
                ),
            ),
        );
    }

    private function messages(Closure $onUpdate): void
    {
        $group = 'Message list ('.ViewsServiceProvider::$loopIterations.' class components)';

        $onUpdate(
            $this->update(
                type: UpdateType::Measurement,
                group: $group,
                description: 'Without file cache',
                measurement: SupportBenchmark::measure(
                    benchmarkables: function() {
                        $this->clearCache();
                        $this->renderView('messages');
                    },
                ),
            ),
        );

        // make sure view is cached
        $this->renderView('messages');

        $onUpdate(
            $this->update(
                type: UpdateType::Measurement,
                group: $group,
                description: 'With file cache',
                measurement: SupportBenchmark::measure(
                    benchmarkables: fn() => $this->renderView('messages'),
                    iterations: ViewsServiceProvider::$benchmarkIterations,
                ),
            ),
        );
    }

    private function clearCache(): void
    {
        Artisan::call('view:clear');
    }

    private function renderView(string $name): void
    {
        View::make(ViewsServiceProvider::$prefix.'::'.$name);
    }
}
