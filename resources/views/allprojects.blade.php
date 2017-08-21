@extends('layouts.app')

@section('content')
    <div class="starter-template text-center">
        <h1>FreelanceXP</h1>
        <p class="lead">All Projects!</p>
    </div>
    <div class="container">
        <div class="row">
                @foreach ($projects as $project)
                    <div class="col-md-6">
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
                                <a href="{{ route('show.user', $project->users[0]->slug) }}">
                                    {{ $project->users[0]->name }}
                                </a>
                                <hr class="m-t-12 m-b-12">
                                {{ str_limit($project->description, 150) }}
                            </div>

                            <div class="panel-footer">
                                <a href="{{ route('show.project', array($project->users[0]->slug, $project->slug)) }}" class="btn btn-primary">
                                    View Project
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
