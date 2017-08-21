@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        {{ $user->name }}
                        @if(Auth::user() && Auth::user()->id == $user->id)
                        <span class="pull-right">
                            <a href="{{ route('edit.user', $user->slug) }}" class="btn btn-default btn-xs">
                                Edit
                            </a>
                        </span>
                        @endif
                    </div>

                    <div class="panel-body">
                        {{ $user->tagline }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @foreach ($projects as $project)
              <div class="col-md-12">
                  <div class="panel panel-default">
                      <div class="panel-heading clearfix">
                          {{ $project->title }}
                      </div>

                      <div class="panel-body">
                          {{-- {!! nl2br(e($project->description)) !!} --}}
                          {{ str_limit($project->description, 180) }}
                      </div>

                      <div class="panel-footer">
                          <a href="{{ route('showAccepted.project', array($user->slug, $project->slug)) }}" class="btn btn-primary">
                              Manage Project
                          </a>
                      </div>
                  </div>
              </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
