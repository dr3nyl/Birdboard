
@if(count($activity->changes['after']) == 1)

    {{ $activity->user->name }} updated the {{ key($activity->changes['after']) }}
    
@else

    {{ $activity->user->name }} Updated the project

@endif