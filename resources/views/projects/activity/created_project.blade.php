@if($activity->user->id == auth()->id())
    You created the project
@else
    {{ $activity->user->name }} created the project
@endif
