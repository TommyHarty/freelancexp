@extends('layouts.app')

@section('content')
    <div class="starter-template text-center">
        <h1>FreelanceXP</h1>
        <p class="lead">Build up your portfolio by volunteering on real world projects!</p>
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
            <div class="text-center">
                <a href="{{ route('all.projects') }}" class="btn btn-primary m-t-15 m-b-15">
                    View All Projects
                </a>
            </div>
        </div>
        <hr>
        <div class="container">
            <div class="row">
                <h2 class="text-center m-b-40">Employers</h2>
                @foreach ($employers as $employer)
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                <strong>{{ $employer->name }}</strong>
                                <div class="pull-right">
                                    {{ $employer->location }}
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="col-sm-2 col-xs-3 text-center user-label">
                                    @if ($employer->photo)
                                        <img src="/uploads/{{ $employer->photo }}" alt="" class="user-photo">
                                    @else
                                        <div class="m-b-35">
                                            <small>No image.</small>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-10 col-xs-9">
                                    {{ str_limit($employer->tagline, 90) }}
                                </div>
                            </div>
                            <div class="panel-footer">
                                <a href="{{ route('show.user', $employer->slug) }}" class="btn btn-primary">View Profile</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('all.employers') }}" class="btn btn-primary m-t-15 m-b-15">
                    View All Employers
                </a>
            </div>
        </div>
        <hr>
        <div class="container">
            <div class="row">
                <h2 class="text-center m-b-40">Freelancers</h2>
                @foreach ($freelancers as $freelancer)
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading clearfix">
                                <strong>{{ $freelancer->name }}</strong>
                                <div class="pull-right">
                                    {{ $freelancer->location }}
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="col-sm-2 col-xs-3 text-center user-label">
                                    @if ($freelancer->photo)
                                        <img src="/uploads/{{ $freelancer->photo }}" alt="" class="user-photo">
                                    @else
                                        <div class="m-b-35">
                                            <small>No image.</small>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-10 col-xs-9">
                                    {{ str_limit($freelancer->tagline, 90) }}
                                </div>
                            </div>
                            <div class="panel-footer">
                                <a href="{{ route('show.user', $freelancer->slug) }}" class="btn btn-primary">View Profile</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <a href="{{ route('all.freelancers') }}" class="btn btn-primary m-t-15 m-b-15">
                    View All Freelancers
                </a>
            </div>
        </div>
@endsection
