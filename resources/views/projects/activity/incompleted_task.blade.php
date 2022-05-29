@if($activity->user->id == auth()->id())
    You incompleted "{{ $activity->subject->body }}"
@else
    {{ $activity->user->name }} incompleted "{{ $activity->subject->body }}"
@endif
