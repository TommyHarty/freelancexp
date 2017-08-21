<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function authorizeRole($role)
    {
        if ($this->role()->where('name', $role)->first()) {
            return true;
        }
        return redirect('/');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_user');
    }

}
