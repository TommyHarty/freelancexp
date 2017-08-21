@extends('layouts.app')

@section('content')
    <div class="starter-template text-center">
        <h1>FreelanceXP</h1>
        <p class="lead">All Freelancers!</p>
    </div>
    <div class="container">
        <div class="row">
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
    </div>
@endsection
