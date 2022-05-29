@if($activity->user->id == auth()->id())
    You created "{{ $activity->subject->body }}"
@else
    {{ $activity->user->name }} created "{{ $activity->subject->body }}"
@endif
