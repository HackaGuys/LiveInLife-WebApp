@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 glazed">
        <h2>{{ $message }}</h2>
        <a href=" {{ url('/') }}">Search for another city</a>
    </div>
</div>
@endsection
