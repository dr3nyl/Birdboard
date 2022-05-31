@extends('layouts.app')

@section('content')
    
    <header class="flex mb-3 py-4">

        <div class="flex justify-between w-full items-end">

            <p class="text-gray-400 text-sm font-normal">
                
                <a href="/projects">My Projects</a> / {{ $project->title }}
            
            </p>
            
            
            <div class="flex items-center">

                @foreach($project->members as $member)

                    <img 
                        class="rounded-full w-8 mr-2" 
                        src="{{ gravatar_url($member->email) }}" 
                        alt="{{ $member->name }}'s avatar">

                @endforeach

                <img 
                    class="rounded-full w-8 mr-2" 
                    src="{{ gravatar_url($project->owner->email) }}"
                    alt="{{ $project->owner->name }}'s avatar">


                <a href="{{ $project->path(). '/edit' }}" class="button ml-4">Edit Project</a>

            </div>

        </div>

    </header>

    <main>

        <div class="lg:flex -mx-3">

            <div class="lg:w-3/4 px-3 mb-6">

                <!-- Tasks -->
                <div class="mb-8">
                    <h2 class="text-gray-400 font-normal text-lg mb-3">Tasks</h2>

                    <div class="card mb-4">
                        <form action="{{ $project->path(). '/tasks' }}" method="post">
                            @csrf
                            <input type="text" class="bg-card w-full" name="body" placeholder="Add a new task..">
                        </form>
                    </div>

                    @foreach($project->tasks as $task)

                        <div class="card mb-3">
                            <form action="{{ $project->path(). '/tasks/'. $task->id }}" method="post">
                                @method('PATCH')
                                @csrf

                                <div class="flex">
                                    <input type="text" class="bg-card w-full {{ $task->completed ? 'text-gray-400 line-through' : 'text-default' }}" name="body" value="{{ $task->body }}" >
                                    <input type="checkbox" class="" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }} >
                                </div>
                            </form>
                        </div>

                    @endforeach

                </div>

                <div>
                    <h2 class="text-gray-400 font-normal text-lg mb-3">General Notes</h2>


                    <form action="{{ $project->path() }}" method="post">
                        @csrf
                        @method('PATCH')

                        <textarea 
                            name="notes"
                            class="text-default card w-full mb-4" 
                            style="min-height: 200px" 
                            placeholder="Anything special that you want to make a note of??">{{ $project->notes }}</textarea>

                        <button type="submit" class="button">Save</button>
                    </form>
                    
                    @include('error')
                    
                </div>

            </div>
                
            <!-- left side bar section -->
            <div class="lg:w-1/4 px-3 lg:py-8">

                <!-- project info -->
                @include('projects.card')

                <!-- invite section -->

                @can('manage', $project)

                    @include('projects.invite')

                @endcan

            </div>

            <div class="lg:w-1/4 px-3 lg:py-5">
                <!-- activity section -->
                @include('projects.activity.card')
            </div>

        </div>

    </main>

@endsection