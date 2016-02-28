@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="col-sm-4">
            <div class="col-xs-12">
                @if ($post->images != null)

                @endif
            </div>
            @foreach($post->images as $image)
                <divl class="col-xs-3">
                    <img class="img-responsive" src="{{ asset('/uploads/' . $post->thumbnail) }}" />
                </divl>
            @endforeach
        </div>
        <div class="col-sm-4">
            <p>
                {{ $post->description }}
            </p>
        </div>
        <div class="col-sm-4">
            <dl>
                <dt>City: </dt>
                <dd>{{ $post->city }}</dd>
                <dt>Province: </dt>
                <dd>{{ $post->province }}</dd>
                <dt>Zip: </dt>
                <dd>{{ $post->zip }}</dd>
                <dt>Bedrooms: </dt>
                <dd>{{ $post->bedrooms }}</dd>
                <dt>Square Ft: </dt>
                <dd>{{ $post->sqfeet }}</dd>
                <dt>Price: </dt>
                <dd>{{ $post->price }}</dd>
            </dl>
        </div>
    </div>
</div>
@endsection
