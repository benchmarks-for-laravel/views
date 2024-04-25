<div>
    @for ($i = 0; $i < \BenchmarksForLaravel\Views\ViewsServiceProvider::$loopIterations; $i++)
        <benchmarks-for-laravel-views::message message="message #{{ $i }}" />
    @endfor
</div>
