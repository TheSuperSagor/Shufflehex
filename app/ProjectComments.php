<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectComments extends Model
{
    protected $fillable = [
        'comment', 'user_id', 'project_id', 'username',
    ];
    protected $dates=['deleted_at'];

    public function posts()
    {
        return $this->belongsTo('App\Project');
    }
}
