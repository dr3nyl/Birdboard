<?php

namespace App\Models;

use App\RecordsActivity;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{   
    use HasFactory, RecordsActivity;

    protected $guarded = [];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function path()
    {
        return  "/projects/{$this->id}";
    }

    public function owner()
    {

        return $this->belongsTo(User::class, 'owner_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    
    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }

    public function activity()
    {
        return $this->hasMany(Activity::class)->latest();
    }

    public function invite(User $user)
    {
        
        return $this->members()->attach($user);
    }

    public function members()
    {

        return $this->belongsToMany(User::class, 'project_members')->withTimestamps();
    }
}
