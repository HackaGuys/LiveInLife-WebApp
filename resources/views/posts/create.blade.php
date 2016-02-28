@extends('layouts.app')

@section('content')
    @if(Session::has('success'))
        <div class="alert-box success">
            <h2>{!! Session::get('success') !!}</h2>
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-4 col-md-offset-4 glazed">
            <h2>Create a listing.</h2>
            {!! Form::open(array('route' => 'post.store', 'files' => 'true')) !!}
            <div class="form-group">
                {!! Form::label('address', 'Address') !!} <br />
                {!! Form::text('address', null, array('class'    => 'form-control',
                                                      'required' => 'required')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('city', 'City') !!} <br />
                {!! Form::text('city', null, array('class'    => 'form-control',
                                                   'required' => 'required')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('province', 'Province') !!} <br />
                {!! Form::select('province', array('Alberta'                   => 'Alberta',
                                                   'British Columbia'          => 'British Columbia',
                                                   'Manitoba'                  => 'Manitoba',
                                                   'Newfoundland and Labrador' => 'Newfoundland and Labrador',
                                                   'New Brunswick'             => 'New Brunswick',
                                                   'Nova Scotia'               => 'Nova Scotia',
                                                   'Ontario'                   => 'Ontario',
                                                   'Prince Edward Island'      => 'Prince Edward Island',
                                                   'Quebec'                    => 'Quebec',
                                                   'Saskatchewan'              => 'Saskatchewan'),
                                                   'British Columbia', array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('zip', 'Zip Code') !!} <br />
                {!! Form::text('zip', null, array('class'    => 'form-control',
                                                  'required' => 'required',
                                                  'pattern'  => '^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1}\d{1}[A-Z]{1}\d{1}$')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('bedrooms', 'Bedrooms') !!} <br />
                {!! Form::number('bedrooms', null, array('class'    => 'form-control',
                                                         'required' => 'required')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('sqfeet', 'Square Feet') !!} <br />
                {!! Form::number('sqfeet', null, array('class'    => 'form-control',
                                                       'required' => 'required')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('price', 'Price') !!} <br />
                {!! Form::number('price', null, array('class'    => 'form-control',
                                                      'required' => 'required')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Description') !!} <br />
                {!! Form::textarea('description', null, array('class'    => 'form-control',
                                                              'required' => 'required')) !!}
            </div>
            <div class="form-group">
                {!! Form::file('images[]', array('multiple'=>true)) !!}
            </div>
            @if(Session::has('error'))
                <p class="errors">{!! Session::get('error') !!}</p>
            @endif
            {!! Form::submit('Submit!', array('class' => 'btn btn-primary')) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection