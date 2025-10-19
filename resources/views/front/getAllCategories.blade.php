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
    @foreach($allCategories as $category)
        <h3>{{ $category->name }}</h3>
        <div class="row">
            @php
                // اسم مميز لكل كاتيجوري في الصفحة
                $pageName = 'page_' . $category->id;

                // خُد رقم الصفحة الخاص بالكاتيجوري من الـ query string
                $page = request()->query($pageName, 1);

                // اعمل paginate مخصص بالاسم ده
                $posts = $category->posts()->latest()->paginate(3, ['*'], $pageName, $page);
            @endphp

            @foreach($posts as $post)
                <div class="col-md-4">
                    <div class="mn-img">
                        <img src="{{ asset($post->images()->first()->path) }}" />
                        <div class="mn-title">
                            <a href="">{{ $post->title }}</a>
                        </div>
                    </div>
                </div>
            @endforeach

            {{ $posts->appends(request()->except($pageName))->links() }}
        </div>
    @endforeach    
</div>



                <div class="col-lg-3">
                    <br>


                    <div class="mn-list">
                        <h2>Outher categories</h2>
                        <ul>
                            @foreach ($categories as $category)
                                <li><a href="">{{ $category->name }}</a></li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection
