@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        @foreach ($posts as $post)
            <div class="row">
                <div class="col-xs-12">
                    <div class="col-sm-4">
                        @if ($post->thumbnail != null)
                            <img class="img-responsive" src="{{ asset('/uploads/' . $post->thumbnail) }}" />
                        @else
                            <img class="img-responsive" src="http://placehold.it/300x200"/>
                        @endif
                    </div>
                    <div class="col-sm-4">
                        <p>
                            @if (count($post->description) > 50)
                                {{ substr($post->description, 0, 50) }}
                            @else
                                {{ $post->description }}
                            @endif
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <dl>
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
                </div>
            </div>
            @endforeach
        <!--<table class="table">
            <tr>
                <th>Image</th>
                <th>Description</th>
                <th>City</th>
                <th>Bedrooms</th>
                <th>Square Ft.</th>
                <th>Price</th>
            </tr>
            @foreach ($posts as $post)
                <tr>
                    <td>
                        @if ($post->thumbnail != null)
                            <img src="{{ asset('/uploads/' . $post->thumbnail) }}" />
                        @else
                            <img src="http://placehold.it/300x200"/>
                        @endif
                    </td>
                    <td>
                        @if (count($post->description) > 50)
                            {{ substr($post->description, 0, 50) }}
                        @else
                            {{ $post->description }}
                        @endif
                    </td>
                    <td>
                        {{ $post->city }}
                    </td>
                    <td>
                        {{ $post->bedrooms }}
                    </td>
                    <td>
                        {{ $post->sqfeet }}
                    </td>
                    <td>
                        {{ $post->price }}
                    </td>
                </tr>
            @endforeach
        </table>-->
    </div>
</div>
@endsection
