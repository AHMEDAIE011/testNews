@extends('layouts.front.app')


@section('body')

    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @foreach ($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ asset($post->images()->first()->path) }}" />
                                    <div class="mn-title">
                                        <a href="">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $posts->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection
