@extends('layouts.app')

@section('content')
    
    <header class="flex mb-3 py-4">

        <div class="flex justify-between w-full items-end">

            <p class="text-gray-400 text-sm font-normal">
                
                <a href="/projects">My Projects</a> / {{ $project->title }}
            
            </p>
            
            <a href="/projects/create" class="button">New Project</a>

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


                    <textarea class="card w-full" style="min-height: 200px">Lorem ipsum dolor.</textarea>
                </div>

            </div>
                
            <div class="lg:w-1/4 px-3 mt-10">
                
                @include('projects.card')

            </div>
        </div>

    </main>

@endsection