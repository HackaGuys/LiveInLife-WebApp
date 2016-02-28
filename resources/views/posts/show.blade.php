@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="col-sm-4">
            <div class="col-xs-12">
                @if ($post->main_image != null)
                    <img id="main_image" class="img-responsive" src="{{ asset('/uploads/' . $post->main_image->filename) }}" />
                @else
                    <img class="img-responsive" src="http://placehold.it/300x200" />
                @endif
            </div>
            @if ($post->main_image != null)
                @foreach($post->images as $image)
                    <divl class="col-xs-4">
                        <img class="img-responsive thumbnail" src="{{ asset('/uploads/' . $image->thumbnail_filename) }}" />
                    </divl>
                @endforeach
            @endif
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
<script>
    $('.thumbnail').hover(function() {
        $('#main_image').attr('src', $(this).attr('src'));
    });
</script>
@endsection
