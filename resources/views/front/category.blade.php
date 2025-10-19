@extends('layouts.front.app')


@section('body')
<br>
                    <br>
                    <br>
                    <br>
                    
    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
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

                <div class="col-lg-3">
                    <br>
                   
                    
                    <div class="mn-list">
                        <h2>Outher categories</h2>
                        <ul>
                            @foreach ($categories as $category)
                                <li><a href="">{{ $category->name}}</a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection
