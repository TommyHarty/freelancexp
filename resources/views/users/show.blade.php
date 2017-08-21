@extends('layouts.app')

@section('content')
<div class="user-header" style="background-image:url('/uploads/{{ $user->banner }}'); background-repeat: no-repeat; background-size:cover; background-position:center center;">
    @if(Auth::user() && Auth::user()->id == $user->id)
        <div class="container">
            <div class="m-t-15">
                <a href="{{ route('edit.user', $user->slug) }}" class="btn btn-default btn-xs">
                    Edit Profile
                </a>
            </div>
        </div>
    @endif
</div>
<div class="container">
    <div class="row">
              <div class="col-lg-2 col-lg-offset-1 col-sm-3 text-center user-label">
                  @if ($user->photo)
                      <img src="/uploads/{{ $user->photo }}" alt="" class="user-photo m-b-30"><br>
                  @else
                      <div class="m-b-25">
                      </div>
                  @endif
                  <div class="label label-success">
                      {{ $user->role->name }}
                  </div>
              </div>
          <div class="col-lg-8 col-sm-8 user-text">
              <div class="col-md-7">
                  <h2>{{ $user->name }}</h2>
              </div>
              <div class="col-md-5 social-icons text-right">
                @if($user->website)
                  <a target="_blank" href="http://{{ $user->website }}"><i class="fa fa-link" aria-hidden="true"></i></a>
                @endif
                @if($user->facebook)
                  <a target="_blank" href="http://{{ $user->facebook }}"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                @endif
                @if($user->instagram)
                  <a target="_blank" href="http://{{ $user->instagram }}"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                @endif
                @if($user->twitter)
                  <a target="_blank" href="http://{{ $user->twitter }}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                @endif
                @if($user->youtube)
                  <a target="_blank" href="http://{{ $user->youtube }}"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                @endif
                @if($user->linkedin)
                  <a target="_blank" href="http://{{ $user->linkedin }}"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                @endif
                @if($user->google)
                  <a target="_blank" href="http://{{ $user->google }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                @endif
                @if($user->flickr)
                  <a target="_blank" href="http://{{ $user->flickr }}"><i class="fa fa-flickr" aria-hidden="true"></i></a>
                @endif
              </div>
              <div class="col-md-12 m-b-25">
                  {!! nl2br(e($user->description)) !!}<br>
                  @if ($user->location)
                      <i class="fa fa-map-marker m-t-15" aria-hidden="true"></i> {{ $user->location }}
                      <span class="m-r-15"></span>
                  @endif
                  @if ($user->phone)
                    <i class="fa fa-phone m-t-15" aria-hidden="true"></i> {{ $user->phone }}
                    <span class="m-r-15"></span>
                  @endif
              </div>
          </div>
        </div>
        @if ($user->projects->count() > 0)
            <hr>
        @endif
        <div class="row">
        <div class="col-md-12">
                @foreach ($projects as $project)
                    @if ($project->status == 'Open For Proposals')
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading clearfix">
                                    {{ $project->title }}
                                    <div class="label label-success pull-right">
                                        {{ $project->status }}
                                    </div>
                                </div>

                                <div class="panel-body">
                                    {{ str_limit($project->description, 130) }}
                                </div>

                                <div class="panel-footer">
                                    <a href="{{ route('show.project', array($project->users[0]->slug, $project->slug)) }}" class="btn btn-primary">
                                        View Project
                                    </a>
                                    @if(Auth::user() && Auth::user()->id == $user->id)
                                    <span class="pull-right">
                                        <a href="{{ route('edit.project', array($user->slug, $project->slug)) }}" class="btn btn-default">
                                            Edit
                                        </a>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @foreach ($projects as $project)
                    @if ($project->status == 'Proposal Accepted')
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading clearfix">
                                    {{ $project->title }}
                                    <div class="label label-danger pull-right">
                                        {{ $project->status }}
                                    </div>
                                </div>

                                <div class="panel-body">
                                    {{ str_limit($project->description, 150) }}
                                </div>

                                <div class="panel-footer">
                                    <a href="{{ route('show.project', array($project->users[0]->slug, $project->slug)) }}" class="btn btn-primary">
                                        View Project
                                    </a>
                                    <a href="{{ route('showAccepted.project', array($user->slug, $project->slug)) }}" class="btn btn-primary">
                                        Manage Project
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @foreach ($projects as $project)
                    @if ($project->status == 'Project Completed')
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading clearfix">
                                    {{ $project->title }}
                                    <div class="label label-default pull-right">
                                        {{ $project->status }}
                                    </div>
                                </div>

                                <div class="panel-body">
                                    {{ str_limit($project->description, 150) }}
                                </div>

                                <div class="panel-footer">
                                    <a href="{{ route('show.project', array($project->users[0]->slug, $project->slug)) }}" class="btn btn-primary">
                                        View Project
                                    </a>
                                </div>
                            </div>
                            @if ($user->role_id == 2)
                                <div class="panel panel-default">
                                    <div class="panel-heading clearfix">
                                        Employer feedback for {{ $project->title }}
                                    </div>

                                    <div class="panel-body">
                                        {!! nl2br(e($project->feedback->body)) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
    </div>
</div>
@endsection
