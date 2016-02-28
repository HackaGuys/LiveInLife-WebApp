@extends('layouts.app')

@section('content')
    @if(Session::has('success'))
        <div class="alert-box success">
            <h2>{!! Session::get('success') !!}</h2>
        </div>
    @endif
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            {!! Form::open(array('route' => 'post.store', 'files' => 'true')) !!}
            <div class="form-group">
                {!! Form::label('address', 'Address') !!} <br />
                {!! Form::text('address', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('city', 'City') !!} <br />
                {!! Form::text('city', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('province', 'Province') !!} <br />
                {!! Form::text('province', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('zip', 'Zip Code') !!} <br />
                {!! Form::text('zip', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('bedrooms', 'Bedrooms') !!} <br />
                {!! Form::number('bedrooms', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('sqfeet', 'Square Feet') !!} <br />
                {!! Form::number('sqfeet', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('price', 'Price') !!} <br />
                {!! Form::text('price', null, array('class' => 'form-control')) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Description') !!} <br />
                {!! Form::textarea('description', null, array('class' => 'form-control')) !!}
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
@endsection