<div class="card mt-3">

    <h2 class="text-default text-lg mb-3">Latest Update</h2>

    <ul class="text-xs">
        @foreach($project->activity as $activity)

            <li class="text-default {{ $loop->last ? '' : 'mb-1' }}">
                
                @include("projects.activity.$activity->description")
                
                <span class="text-gray-400">{{ $activity->created_at->diffForHumans() }}</span>

            </li>
        @endforeach
    </ul>
</div>