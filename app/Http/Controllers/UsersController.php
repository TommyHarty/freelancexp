<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Project;
use Illuminate\Http\Request;

class UsersController extends Controller
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if($user->description == null){
            if (Auth::user() && $user->id == Auth::user()->id) {
                return redirect("/$user->slug/edit");
            }
            return redirect('/');
        }
        $projects = $user->projects()->get();
        return view('users.show', compact('user', 'projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if($user->id == Auth::user()->id) {
            return view('users.edit', compact('user'));
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
    public function update(Request $request, User $user)
    {
        $this->validate(request(), [
            'photo' => 'dimensions:ratio=1/1',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $request->file('photo')->store('uploads');
            $file->move('uploads' , $file->getClientOriginalName());
            $user->photo = $request->file('photo')->getClientOriginalName();
        }

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $path = $request->file('banner')->store('uploads');
            $file->move('uploads' , $file->getClientOriginalName());
            $user->banner = $request->file('banner')->getClientOriginalName();
        }

        $user->tagline = request('tagline');
        $user->description = request('description');
        $user->phone = request('phone');
        $user->location = request('location');
        $user->website = request('website');
        $user->facebook = request('facebook');
        $user->google = request('google');
        $user->twitter = request('twitter');
        $user->linkedin = request('linkedin');
        $user->youtube = request('youtube');
        $user->instagram = request('instagram');
        $user->flickr = request('flickr');

        $user->save();

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

}
