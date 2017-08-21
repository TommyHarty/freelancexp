<?php

namespace App\Http\Controllers;

use Auth;
use Mail;
use App\User;
use App\Project;
use App\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
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
        Message::create([
            'project_id' => $project->id,
            'body' => request('body'),
            'user_id' => auth()->id()
        ]);

        foreach ($project->users as $otherUser) {
            if ($otherUser->email != Auth::user()->email) {
                $data = array(
                    'name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'project' => $project->title,
                    'body' => $request->body,
                    'url' => 'http://freelancexp.dev',
                    'user_slug' => $otherUser->slug,
                    'project_slug' => $project->slug,
                    'user_email' => $otherUser->email
                );
            }
        }

        Mail::send('emails.message', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to($data['user_email']);
        });

        return redirect()->back();
    }
}
