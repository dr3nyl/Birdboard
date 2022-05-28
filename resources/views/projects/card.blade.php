<div class="card flex flex-col" style="height: auto">

    <h3 class="font-normal text-xl py-4 -ml-5 border-l-4 border-blue-900 pl-4 mb-3">
        <a href="{{ $project->path() }}">{{ $project->title }}</a>
    </h3>

    <div class="text-gray-400 mb-4 flex-1">{{ \Illuminate\Support\Str::limit($project->description, 100) }}</div>


    @can('manage', $project)

        <footer>
            <form class="text-right" action="{{ $project->path() }}" method="post">
                @csrf
                @method('DELETE')

                <button type="submit" class="text-sm">Delete</button>

            </form>
        </footer>

    @endcan
    

</div>
