
@if(count($activity->changes['after']) == 1)

    @if($activity->user->id == auth()->id())

        You updated the {{ key($activity->changes['after']) }}

    @else

        {{ $activity->user->name }} updated the {{ key($activity->changes['after']) }}

    @endif
@else

    {{ $activity->user->name }} Updated the project

@endif