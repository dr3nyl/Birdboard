@if($activity->user->id == auth()->id())
    You completed "{{ $activity->subject->body }}"
@else
    {{ $activity->user->name }} completed "{{ $activity->subject->body }}"
@endif
