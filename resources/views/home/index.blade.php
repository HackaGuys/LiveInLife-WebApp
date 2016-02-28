@extends('layouts.app')

@section('content')
    @if (Session::has('message'))
        <div class="row">
            <div class="alert alert-success col-md-8 col-md-offset-2">
                {{ Session::get('message') }}
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2 glazed">
            <h2>Find your dream home.</h2>
            <p>
                Enter your desired city and province, and we'll show you housing that meets your needs and the information you
                care about. Discover near-by shops, restaurants, parks, schools, weather reports and more.
            </p>
            {!! Form::open(array('url' => 'search')) !!}
            <div class="form-group">
                <div class="input-group">
                    {!! Form::text('city', 'Vancouver', array('class'       => 'form-control',
                                                              'placeholder' => 'Enter your city name',
                                                              'required'    => 'required')) !!}
                    <span class="input-group-btn">
                        <select class="btn" name="province">
                            <option>Alberta</option>
                            <option selected>British Columbia</option>
                            <option>Manitoba</option>
                            <option>Newfoundland and Labrador</option>
                            <option>New Brunswick</option>
                            <option>Nova Scotia</option>
                            <option>Ontario</option>
                            <option>Prince Edward Island</option>
                            <option>Quebec</option>
                            <option>Saskatchewan</option>
                        </select>
                    </span><!-- /btn-group -->
                </div>
            </div>
            {!! Form::submit('Find my dream home', array('class' => 'btn btn-default pull-right')) !!}
            {!! Form::close() !!}
            <a href="{{ url('post/create') }}">Have an apartment or house for sale? Create a posting now.</a>
        </div>
    </div>
@endsection
