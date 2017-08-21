<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use App\User;
use App\Project;
use App\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, User $user, Project $project)
    {
        $request->user()->authorizeRole('Employer');
        return view('feedback.create', compact('user', 'project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user, Project $project)
    {
        Feedback::create([
            'project_id' => $project->id,
            'user_id' => $project->users[1]->id,
            'employer_id' => auth()->id(),
            'body' => request('body'),
        ]);

        $project->status = 'Project Completed';
        $project->save();

        $data = array(
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'project' => $project->title,
            'body' => $request->body,
            'url' => 'http://freelancexp.dev',
            'user_slug' => $project->users[1]->slug,
            'project_slug' => $project->slug,
            'user_email' => $project->users[1]->email
        );

        Mail::send('emails.feedback', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to($data['user_email']);
        });

        return redirect('/');
    }

}
