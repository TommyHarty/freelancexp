@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update Profile</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('update.user', $user->slug) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}

                        @if (!$user->photo)
                            <div class="form-group">
                                <label for="photo" class="col-md-4 control-label">Profile Photo:</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" id="photo" name="photo"  value="{{ old('photo')}}">
                                </div>
                            </div>
                        @endif
                        @if (!$user->banner)
                            <div class="form-group">
                                <label for="banner" class="col-md-4 control-label">Profile Banner:</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" id="banner" name="banner"  value="{{ old('banner')}}">
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="tagline" class="col-md-4 control-label">Short Description:</label>
                            <div class="col-md-6">
                                <textarea name="tagline" rows="2" class="form-control" id="tagline">{{ old('tagline', $user->tagline)}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Description:</label>
                            <div class="col-md-6">
                                <textarea name="description" rows="5" class="form-control" id="description">{{ old('description', $user->description)}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-md-4 control-label">Phone:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="phone" name="phone"  value="{{ old('phone', $user->phone)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="location" class="col-md-4 control-label">Location:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="location" name="location"  value="{{ old('location', $user->location)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="website" class="col-md-4 control-label">Website:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="website" name="website"  value="{{ old('website', $user->website)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="facebook" class="col-md-4 control-label">Facebook:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="facebook" name="facebook"  value="{{ old('facebook', $user->facebook)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="google" class="col-md-4 control-label">Google Plus:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="google" name="google"  value="{{ old('google', $user->google)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="twitter" class="col-md-4 control-label">Twitter:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="twitter" name="twitter"  value="{{ old('twitter', $user->twitter)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="linkedin" class="col-md-4 control-label">LinkedIn:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="linkedin" name="linkedin"  value="{{ old('linkedin', $user->linkedin)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="youtube" class="col-md-4 control-label">YouTube:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="youtube" name="youtube"  value="{{ old('youtube', $user->youtube)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="instagram" class="col-md-4 control-label">Instagram:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="instagram" name="instagram"  value="{{ old('instagram', $user->instagram)}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="flickr" class="col-md-4 control-label">Flickr:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="flickr" name="flickr"  value="{{ old('flickr', $user->flickr)}}">
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
