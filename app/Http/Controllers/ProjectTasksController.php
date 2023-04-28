<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{

    public function index(Request $request)
    {
        return TaskResource::collection(
            Task::where('project_id', $request->id)->get()
        );
    }
    
    public function store(Project $project)
    {
        $this->authorize('update', $project);
        
        request()->validate(['body' => 'required']);
        
        $project->addTask(request('body'));

        return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {
        $this->authorize('update', $project);

        $attributes = request()->validate(['body' => 'required']);

        $task->update($attributes);

        request('completed') ? $task->complete() : $task->incomplete();

        //return redirect($project->path());
    }
    
}
