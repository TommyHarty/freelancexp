@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <strong>{{ $project->users[0]->name }}</strong>
                    </div>

                    <div class="panel-body">
                        {{ $project->users[0]->tagline }}
                    </div>

                    <div class="panel-footer">
                        <a href="{{ route('show.user', $project->users[0]->slug) }}" class="btn btn-primary">
                            View Profile
                        </a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        <strong>{{ $project->users[1]->name }}</strong>
                    </div>

                    <div class="panel-body">
                        {{ $project->users[1]->tagline }}
                    </div>

                    <div class="panel-footer">
                        <a href="{{ route('show.user', $project->users[1]->slug) }}" class="btn btn-primary">
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
                        @if ($user->role_id == 1)
                            <span class="pull-right">
                                <a href="{{ route('create.feedback', array($user->slug, $project->slug)) }}" class="btn btn-default btn-xs">
                                    Mark As Complete
                                </a>
                            </span>
                        @endif
                    </div>

                    <div class="panel-body">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('store.message', array($user->slug, $project->slug)) }}" enctype="multipart/form-data">
                                {{ csrf_field() }}

                            <div class="form-group">
                                <div class="col-md-12">
                                    <textarea name="body" rows="5" class="form-control" id="body">{{ old('body')}}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>

                @foreach ($messages as $message)
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <a href="{{ route('show.user', $message->user->slug) }}">
                                <strong>{{ $message->user->name }}</strong>
                            </a> sent a message
                        </div>

                        <div class="panel-body">
                            {!! nl2br(e($message->body)) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
