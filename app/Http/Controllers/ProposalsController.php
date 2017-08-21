<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use App\User;
use App\Project;
use App\Proposal;
use Illuminate\Http\Request;

class ProposalsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, Project $project)
    {
        Proposal::create([
            'project_id' => $project->id,
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        $data = array(
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'project' => $project->title,
            'body' => $request->body,
            'url' => 'http://freelancexp.dev',
            'user_slug' => $user->slug,
            'project_slug' => $project->slug,
            'user_email' => $user->email
        );

        Mail::send('emails.proposal', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to($data['user_email']);
        });

        return redirect()->back();
    }

    public function acceptProposal(Request $request, Project $project)
    {
        $project->status = 'Proposal Accepted';
        $project->save();
        $project->users()->attach(request('user_id'));
        return redirect()->back();
    }

}
