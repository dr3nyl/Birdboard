<div class="card" style="height: 200px">

    <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-blue-900 pl-4 mb-3">
        <a href="{{ $project->path() }}">{{ $project->title }}</a>
    </h3>

    <div class="text-gray-400">{{ \Illuminate\Support\Str::limit($project->description, 100) }}</div>

</div>
