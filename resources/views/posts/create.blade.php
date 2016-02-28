@extends('layouts.app')

@section('content')
    {!! Form::open(array('route' => 'posts.store')) !!}
    <div>
        {!! Form::label('address', 'Address') !!} <br />
        {!! Form::text('address') !!}
    </div>
    <div>
        {!! Form::label('city', 'City') !!} <br />
        {!! Form::text('city') !!}
    </div>
    <div>
        {!! Form::label('provice', 'City') !!} <br />
        {!! Form::text('province') !!}
    </div>
    <div>
        {!! Form::label('zip', 'Zip Code') !!} <br />
        {!! Form::text('zip') !!}
    </div>
    <div>
        {!! Form::label('bedrooms', 'Bedrooms') !!} <br />
        {!! Form::number('bedrooms') !!}
    </div>
    <div>
        {!! Form::label('sqfeet', 'Square Feet') !!} <br />
        {!! Form::number('sqfeet') !!}
    </div>
    <div>
        {!! Form::label('price', 'Price') !!} <br />
        {!! Form::text('price') !!}
    </div>


    {!! Form::submit('Submit!', array('class' => 'btn btn-primary')) !!}
    {!! Form::close() !!}
@endsection