@extends('layouts.app')

@section('content')
    
    <header class="flex mb-3 py-4">

        <div class="flex justify-between w-full items-end">

            <p class="text-gray-400 text-sm font-normal">
                
                <a href="/projects">My Projects</a> / {{ $project->title }}
            
            </p>
            
            <a href="{{ $project->path(). '/edit' }}" class="button">Edit Project</a>

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
                            <input type="text" class="w-full" name="body" placeholder="Add a new task..">
                        </form>
                    </div>

                    @foreach($project->tasks as $task)

                        <div class="card mb-3">
                            <form action="{{ $project->path(). '/tasks/'. $task->id }}" method="post">
                                @method('PATCH')
                                @csrf

                                <div class="flex">
                                    <input type="text" class="w-full {{ $task->completed ? 'text-gray-400' : '' }}" name="body" value="{{ $task->body }}" >
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
                            class="card w-full mb-4" 
                            style="min-height: 200px" 
                            placeholder="Anything special that you want to make a note of??">{{ $project->notes }}</textarea>

                        <button type="submit" class="button">Save</button>
                    </form>
                    
                    @if($errors->any())
                        <div class="field mt-6">
                            @foreach($errors->all() as $error)
                                <li class="text-sm text-red-500">{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    
                </div>

            </div>
                
            <div class="lg:w-1/4 px-3 lg:py-8">
                
                @include('projects.card')

                @include('projects.activity.card')

            </div>
        </div>

    </main>

@endsection