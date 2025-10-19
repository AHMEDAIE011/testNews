@extends('layouts.front.app')
@section('body')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">News</a></li>
                <li class="breadcrumb-item active">News details</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    {{-- <!-- Carousel -->
                    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#newsCarousel" data-slide-to="1"></li>
                            <li data-target="#newsCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($mainPost->images as $image)
                                <div class="carousel-item @if ($loop->index == 0) active @endif">
                                    <img src="{{ asset($image->path) }}" class="d-block w-100" alt="First Slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $mainPost->title }}</h5>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Add more carousel-item blocks for additional slides -->
                        </div>
                        <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div> --}}
                    <div class="sn-content">{{ $mainPost->desc }}</div>

                    <!-- Comment Section -->
                    <div class="comment-section">
                        @if (auth()->user())
                            @if ($mainPost->comment_able == true)
                                <form id="commentForm">
                                  @csrf
                                    <div class="comment-input">
                                        <input name="comment" type="text" placeholder="Add a comment..." id="commentBox" />
                                        <input  name="user_id" type="hidden" value="{{ auth()->user()->id }}" />
                                        <input name="post_id" type="hidden" value="{{ $mainPost->id }}" />
                                        <button type="submit">Comment</button>
                                    </div>
                                </form>
                            @endif
                        @else
                            <div class="alert alert-info">
                                unable to comment
                            </div>
                        @endif
                    <div style="display: none" id="errorMsg" class="alert alert-danger"></div>

                        <!-- Display Comments -->
                        <div class="comments">
                            @foreach ($mainPost->comments as $comment)
                                <div class="comment">
                                    <img src="{{ asset($comment->user->image) }}" alt="User Image" class="comment-img" />
                                    <div class="comment-content">
                                        <span class="username">{{ $comment->user->name }}</span>
                                        <p class="comment-text">{{ $comment->comment }}.</p>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Add more comments here for demonstration -->
                        </div>

                        <!-- Show More Button -->
                        <button id="showMoreBtn"  class="show-more-btn">Show more</button>
                    </div>

                    <!-- Related News -->
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="row sn-slider">
                            @foreach ($category_belongsTo_posts as $post)
                                <div class="col-md-4">
                                    <div class="sn-img">
                                        <img src="{{ asset($post->images()->first()->path) }}" class="img-fluid"
                                            alt="Related News {{ $loop->index + 1 }}" />
                                        <div class="sn-title">
                                            <a href="{{ route('front.post.show', $post->slug) }}">{{ $post->title }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">In This Category</h2>
                            <div class="news-list">
                                @foreach ($category_belongsTo_posts as $post)
                                    <div class="nl-item">
                                        <div class="nl-img">
                                            <img src="{{ asset($post->images()->first()->path) }}" />
                                        </div>
                                        <div class="nl-title">
                                            <a href="{{ route('front.post.show', $post->slug) }}">{{ $post->title }}</a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <div class="image">
                                <a href="https://htmlcodex.com"><img src="{{ asset('assets/front') }}/img/ads-2.jpg"
                                        alt="Image" /></a>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <div class="tab-news">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#featured">Latest</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#popular">Popular</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div id="featured" class="container tab-pane active">
                                        @foreach ($latest_posts as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src=" {{ asset($post->images()->first()->path) }}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a
                                                        href="{{ route('front.post.show', $post->slug) }}">{{ $post->title }}</a>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                    <div id="popular" class="container tab-pane fade">

                                        @foreach ($gretest_posts_comments as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src=" {{ asset($post->images()->first()->path) }}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a
                                                        href="{{ route('front.post.show', $post->slug) }}">{{ $post->title }}</a>
                                                </div>

                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <div class="image">
                                <a href="https://htmlcodex.com"><img src="{{ asset('assets/front') }}/img/ads-2.jpg"
                                        alt="Image" /></a>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li><a
                                                href="">{{ $category->name }}</a><span>({{ $category->Posts()->count() }})</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <div class="image">
                                <a href="https://htmlcodex.com"><img src="{{ asset('assets/front') }}/img/ads-2.jpg"
                                        alt="Image" /></a>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h2 class="sw-title">Tags Cloud</h2>
                            <div class="tags">
                                <a href="">National</a>
                                <a href="">International</a>
                                <a href="">Economics</a>
                                <a href="">Politics</a>
                                <a href="">Lifestyle</a>
                                <a href="">Technology</a>
                                <a href="">Trades</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Single News End-->
@endsection

@push('js')
    <script>
      $(document).on('click','#showMoreBtn',function (e) {
        e.preventDefault();
        $.ajax({
          url:'{{ route('front.post.getAllComments',$mainPost->slug ) }}',
          type:'GET',
          success:function(data){
            
          },
          error:function(data){},
          

        });
     });






    $(document).on('submit','#commentForm',function (e) {
      e.preventDefault();
      var formData = new FormData($(this)[0]);
          $('#commentBox').val('');

      $.ajax({
        url:'{{ route('front.post.store')}}',
        type:'POST',
        data: formData,
        processData:false,
        contentType:false,
        success:function(data){
          $('#errorMsg').hide();
          $('.comments').prepend(`
            
            <div class="comment">
                                    <img src="{{ asset('${data.comment.user.image}') }}" alt="User Image" class="comment-img" />
                                    <div class="comment-content">
                                        <span class="username">${data.comment.user.name} |  ${data.comment.id}</span>
                                        <p class="comment-text">${data.comment.comment}.</p>
                                    </div>
                                </div>
            
            `);
        },
        error:function(data){

          var response = $.parseJSON(data.responseText);
          $('#errorMsg').text(response.errors.comment).show();
        },
      });
    });
    </script>

    
@endpush