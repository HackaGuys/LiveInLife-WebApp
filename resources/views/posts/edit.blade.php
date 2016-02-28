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
            <h2>Edit your listing.</h2>
            {!! Form::open(array('route' => array('post.update', $post->id), 'method' => 'put')) !!}
            <div class="form-group">
                {!! Form::label('address', 'Address') !!} <br />
                {!! Form::text('address', $post->address, array('class'    => 'form-control',
                                                                'required' => 'required')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('city', 'City') !!} <br />
                {!! Form::text('city', $post->city, array('class'    => 'form-control',
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
                                                   $post->province, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('zip', 'Zip Code') !!} <br />
                {!! Form::text('zip', $post->zip, array('class'    => 'form-control',
                                                        'required' => 'required',
                                                        'pattern'  => '^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1}\d{1}[A-Z]{1}\d{1}$')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('bedrooms', 'Bedrooms') !!} <br />
                {!! Form::number('bedrooms', $post->bedrooms, array('class'    => 'form-control',
                                                                    'required' => 'required')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('sqfeet', 'Square Feet') !!} <br />
                {!! Form::number('sqfeet', $post->sqfeet, array('class'    => 'form-control',
                                                                'required' => 'required')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('price', 'Price') !!} <br />
                {!! Form::number('price', $post->price, array('class'    => 'form-control',
                                                              'required' => 'required')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Description') !!} <br />
                {!! Form::textarea('description', $post->description, array('class'    => 'form-control',
                                                                            'required' => 'required')) !!}
            </div>
            @if(Session::has('error'))
                <p class="errors">{!! Session::get('error') !!}</p>
            @endif
            {!! Form::submit('Submit!', array('class' => 'btn btn-primary')) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection