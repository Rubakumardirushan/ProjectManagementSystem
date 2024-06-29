<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;
class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'title', 
        'status',
        'project_id'
    ];
    public function project(){
        return $this->belongsTo(Project::class);
    }
}
