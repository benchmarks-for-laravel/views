<div>
    @for ($i = 0; $i < \BenchmarksForLaravel\Views\ViewsServiceProvider::$loopIterations; $i++)
        <benchmarks-for-laravel-views::avatar :name="'Taylor'" class="mt-3" />
    @endfor
</div>
