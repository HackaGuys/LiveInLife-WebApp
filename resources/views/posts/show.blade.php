@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 glazed">
        <h2>Posting Details</h2>
        <div class="col-md-4 col-xs-6">
            <div class="col-xs-12">
                @if ($post->main_image != null)
                    <a href="#">
                        <img id="main_image" class="img-responsive" src="{{ asset('/uploads/' . $post->main_image->filename) }}" />
                    </a>
                @else
                    <img class="img-responsive" src="http://placehold.it/300x200" />
                @endif
            </div>
            @if ($post->main_image != null)
                @foreach($post->images as $image)
                    <div class="col-xs-4">
                        <a href="#">
                            <img class="img-responsive thumbnail" src="{{ asset('/uploads/' . $image->thumbnail_filename) }}"  data="{{ asset('/uploads/' . $image->filename) }}"/>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-md-4 hidden-sm hidden-xs">
            <b>Description:</b>
            <p>
                {{ $post->description }}
            </p>
        </div>
        <div class="col-md-4 col-xs-6">
            <dl>
                <dt>Address: </dt>
                <dd>{{ $post->address }}</dd>
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
                <dt>Contact: </dt>
                <dd>{{ $post->email }}</dd>
            </dl>
        </div>
        <div class="col-xs-8 col-xs-offset-2 visible-sm visible-xs">
            <p>
                <b>Description:</b>
                {{ $post->description }}
            </p>
        </div>

        <div class="col-md-12">
            <h2>Nearby Hotspots</h2>
            @foreach($post->venues as $venue)
                <div class="venue">
                    <div><img src="{{ $venue->categories[0]->icon->prefix }}64{{$venue->categories[0]->icon->suffix}}" class="category-icon"/></div>
                    <div class="venue-info">
                        <div>{{$venue->name}}</div>
                        <div>{{$venue->contact->formattedPhone or ""}}</div>
                        <div>{{$venue->location->address or ""}}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="Image" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="modal-body">
                <img class="img-responsive" src="" id="imagepreview" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('.thumbnail').hover(function() {
        $('#main_image').attr('src', $(this).attr('data'));
    });
    $("#main_image").on("click", function() {
        $('#imagepreview').attr('src', $(this).attr('src'));
        $('#imagemodal').modal('show');
    });
    $(".thumbnail").on("click", function() {
        $('#imagepreview').attr('src', $(this).attr('data'));
        $('#imagemodal').modal('show');
    });
</script>
@endsection
