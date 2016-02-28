@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 glazed">
        <h2>My Posts</h2>
        @foreach ($posts as $post)
            <hr />
            <div class="row">
                <div class="col-xs-12">
                    <a href=" {{ url('post/' . $post->id) }} ">
                        <div class="col-sm-4">
                            @if ($post->thumbnail != null)
                                <img class="img-responsive" src="{{ asset('/uploads/' . $post->thumbnail) }}" />
                            @else
                                <img class="img-responsive" src="http://placehold.it/300x200"/>
                            @endif
                        </div>
                    </a>
                    <div class="col-sm-4">
                        <p>
                            @if (strlen($post->description) > 150)
                                hi
                                {{ substr($post->description, 0, 150) }}...
                            @else
                                {{ $post->description }}
                            @endif
                            <br />
                            <a href=" {{ url('post/' . $post->id) }} ">View Details</a>
                        </p>
                    </div>
                    <div class="col-sm-2">
                        <dl>
                            <dt>Address: </dt>
                            <dd>{{ $post->address }}</dd>
                            <dt>City: </dt>
                            <dd>{{ $post->city }}</dd>
                            <dt>Bedrooms: </dt>
                            <dd>{{ $post->bedrooms }}</dd>
                            <dt>Square Ft: </dt>
                            <dd>{{ $post->sqfeet }}</dd>
                            <dt>Price: </dt>
                            <dd>{{ $post->price }}</dd>
                        </dl>
                    </div>
                    <div class="col-sm-2">
                        <a class="btn btn-primary" href="{{ route('post.edit', $post->id) }}"><span class="glyphicon glyphicon-pencil"></span></a>
                        {!! Form::open(array('route' => array('post.destroy', $post->id), 'method' => 'delete')) !!}
                        <button type="submit" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash"></span></button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    $(".delete").popConfirm();
</script>
@endsection
