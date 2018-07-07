<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $timestamps = false;

    protected $fillable = [ 'task_id', 'title', 'description', 'completed', 'score', 'user_id', 'reopen_at' ];

    protected $hidden = [ 'id' ];
}
