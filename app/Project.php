<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'link', 'logo', 'screenshots', 'related_story_image', 'shuffle_box_image', 'category', 'description', 'user_id', 'tags',
    ];

    protected $dates = ['deleted_at'];

    public function project_votes() {
        return $this->hasMany('App\ProjectVotes');
    }

    public function comment_votes() {
        return $this->hasMany('App\CommentVote');
    }

    public function comment_reply_votes() {
        return $this->hasMany('App\CommentReplyVote');
    }

    public function project_comments() {
        return $this->hasMany('App\ProjectComments');
    }
    public function replies() {
        return $this->hasMany('App\Reply');
    }

    public function users() {
        return $this->belongsTo('App\User');
    }

    public function saved_projects() {
        return $this->hasMany('App\SavedProject');
    }

    public function folders() {
        return $this->belongsTo('App\Folder');
    }
}
