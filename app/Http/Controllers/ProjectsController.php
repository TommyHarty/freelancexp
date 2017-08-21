<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Project;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRole('Employer');
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRole('Employer');

        $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        $project = Project::create([
            'title' => request('title'),
            'description' => request('description'),
            'status' => 'Open For Proposals',
            'slug' => strtolower(str_replace(' ', '-', request('title'))),
        ]);

        $project->users()->attach(Auth::user()->id);

        return redirect("/");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Project $project)
    {
        $proposals = $project->proposals;
        return view('projects.show', compact('user', 'project', 'proposals'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user, Project $project)
    {
        $request->user()->authorizeRole('Employer');
        if ($user == Auth::user() && $project->status == 'Open For Proposals') {
          return view('projects.edit', compact('user', 'project'));
        }
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, User $user)
    {
        $request->user()->authorizeRole('Employer');
        $project->title = request('title');
        $project->description = request('description');
        $project->slug = strtolower(str_replace(' ', '-', request('title')));

        $project->save();

        return redirect("/$user->slug");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function acceptedProjects(User $user)
    {
        if ($user == Auth::user()) {
            $projects = $user->projects()->where(['status' => 'Proposal Accepted'])->get();
            return view('projects.accepted', compact('user', 'projects'));
        } else {
            return redirect('/');
        }
    }

    public function acceptedShow(User $user, Project $project)
    {
        $messages = $project->messages()->orderBy('created_at', 'desc')->get();

        if ($user->id == Auth::user()->id) {
            if ($user->id == $project->users[0]->id OR $user->id == $project->users[1]->id) {
                return view('projects.acceptedShow', compact('user', 'project', 'messages'));
            } else {
                return redirect('/');
            }
        } else {
            return redirect('/');
        }
    }

}
