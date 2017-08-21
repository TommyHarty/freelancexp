@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">How did {{ $project->users[1]->name }} do on this project?</div>
              <div class="panel-body">
                  <form class="form-horizontal" method="POST" action="{{ route('store.feedback', $project->slug) }}" enctype="multipart/form-data">
                      {{ csrf_field() }}

                      <div class="form-group">
                          <label for="body" class="col-md-4 control-label">Feedback:</label>
                          <div class="col-md-6">
                              <textarea name="body" rows="10" class="form-control" id="body">{{ old('body')}}</textarea>
                          </div>
                      </div>

                      <div class="col-md-4"></div>
                      <div class="col-md-6">
                          <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </div>
</div>
@endsection
