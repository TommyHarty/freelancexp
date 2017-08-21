<?php

namespace App\Http\Controllers;

use App\User;
use App\Project;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function welcome()
    {
        $projects = Project::orderBy('created_at', 'desc')->where(['status' => 'Open For Proposals'])->take(4)->get();
        $employers = User::orderBy('created_at', 'desc')->where(['role_id' => '1'])->take(4)->get();
        $freelancers = User::orderBy('created_at', 'desc')->where(['role_id' => '2'])->take(4)->get();
        return view('welcome', compact('projects', 'employers', 'freelancers'));
    }

    public function allProjects()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();
        return view('allprojects', compact('projects'));
    }

    public function allEmployers()
    {
        $employers = User::orderBy('created_at', 'desc')->where(['role_id' => '1'])->get();
        return view('allemployers', compact('employers'));
    }

    public function allFreelancers()
    {
        $freelancers = User::orderBy('created_at', 'desc')->where(['role_id' => '2'])->get();
        return view('allfreelancers', compact('freelancers'));
    }

}
