@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Profile</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('update.project', $project->slug) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">Title:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="title" name="title"  value="{{ old('title', $project->title)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Description:</label>
                            <div class="col-md-6">
                                <textarea name="description" rows="10" class="form-control" id="description">{{ old('description', $project->description)}}</textarea>
                            </div>
                        </div>

                        <div class="col-md-4"></div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
