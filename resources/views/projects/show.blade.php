@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <strong>{{ $user->name }}</strong>
                    </div>

                    <div class="panel-body">
                        {{ $user->tagline }}
                    </div>

                    <div class="panel-footer">
                        <a href="{{ route('show.user', $user->slug) }}" class="btn btn-primary">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <strong>{{ $project->title }}</strong>
                        @if ($project->status == 'Open For Proposals')
                            <div class="label label-success pull-right">
                        @elseif ($project->status == 'Proposal Accepted')
                            <div class="label label-danger pull-right">
                        @else
                            <div class="label label-default pull-right">
                        @endif
                            {{ $project->status }}
                        </div>

                    </div>

                    <div class="panel-body">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>

                @if(Auth::user() && Auth::user()->id != $user->id && $project->status == 'Open For Proposals')
                    @if (Auth::user()->role_id == 2)
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            Tell
                            <a href="{{ route('show.user', $user->slug) }}">
                                {{ $user->name }}
                            </a>
                            why you are right for this job...
                        </div>

                        <div class="panel-body">
                            <form class="form-horizontal" method="POST" action="{{ route('store.proposal', array($user->slug, $project->slug)) }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                <div class="form-group">
                                    <div class="col-md-12">
                                        <textarea name="body" rows="5" class="form-control" id="body">{{ old('body')}}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Proposal</button>
                            </form>
                        </div>
                    </div>
                    @endif
                @elseif (Auth::guest())
                    <div class="text-center">
                        <a href="{{ route('login') }}">Login</a> or
                        <a href="{{ route('register') }}">register</a> to send a proposal.<br><br>
                    </div>
                @endif

                @foreach ($proposals as $proposal)
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <a href="{{ route('show.user', $proposal->user->slug) }}">
                                {{ $proposal->user->name }}
                            </a> sent a proposal
                        </div>

                        <div class="panel-body">
                            {!! nl2br(e($proposal->body)) !!}
                        </div>

                        @if(Auth::user() && Auth::user()->id == $user->id && $project->status == 'Open For Proposals')
                            <div class="panel-footer clearfix">
                              <form class="form-horizontal" method="POST" action="{{ route('accept.proposal', $project->slug) }}" enctype="multipart/form-data">
                                  {{ csrf_field() }}

                                  <input type="hidden" name="user_id" value="{{ $proposal->user->id }}">

                                  <button type="submit" class="btn btn-success">Accept Proposal</button>
                              </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
