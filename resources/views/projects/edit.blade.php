@extends('layouts.app')

@section('content')
        
    <div class="bg-card lg:w-1/2 lg:mx-auto bg-white py-12 px-16 rounded shadow">
        <h1 class="text-default text-2xl font-normal mb-10 text-center">Edit your Project</h1>

        <form method="POST"
        action="{{ $project->path() }}"
        class="">
        @method('PATCH')
            
        @include('projects.form', [
                        'buttonText' => 'Update Project'])

        </form>

    </div>
    
        
@endsection