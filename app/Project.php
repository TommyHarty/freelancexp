<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }

}
