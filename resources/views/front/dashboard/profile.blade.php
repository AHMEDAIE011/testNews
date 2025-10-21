@extends('layouts.front.app')


@section('body')
    <!-- Top Bar Start -->
<!-- Profile Start -->
<div class="dashboard container">
  <!-- Sidebar -->
  <aside class="col-md-3 nav-sticky dashboard-sidebar">
      <!-- User Info Section -->
      <div class="user-info text-center p-3">
          <img src="{{ asset(auth()->user()->image) }}" alt="User Image" class="rounded-circle mb-2"
              style="width: 80px; height: 80px; object-fit: cover" />
          <h5 class="mb-0" style="color: #ff6f61">{{ Auth::guard('web')->user()->name }}</h5>
      </div>

      <!-- Sidebar Menu -->
      <div class="list-group profile-sidebar-menu">
          <a href="./dashboard.html" class="list-group-item list-group-item-action active menu-item" data-section="profile">
              <i class="fas fa-user"></i> Profile
          </a>
          <a href="./notifications.html" class="list-group-item list-group-item-action menu-item" data-section="notifications">
              <i class="fas fa-bell"></i> Notifications
          </a>
          <a href="./setting.html" class="list-group-item list-group-item-action menu-item" data-section="settings">
              <i class="fas fa-cog"></i> Settings
          </a>
      </div>
  </aside>

  <!-- Main Content -->
  <div class="main-content">
      <!-- Profile Section -->
      <section id="profile" class="content-section active">
          <h2>User Profile</h2>
          <div class="user-profile mb-3">
              <img src="{{ asset(auth()->user()->image) }}" alt="User Image" class="profile-img rounded-circle" style="width: 100px; height: 100px;" />
              <span class="username">{{ auth()->user()->name }}</span>
          </div>
          <br>

          <!-- Add Post Section -->
          <section id="add-post" class="add-post-section mb-5">
              <h2>Add Post</h2>

                @if (session()->has('errors'))
                    <div class="alert alert-danger">
                        @foreach (session('errors')->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif

             <form action="{{ route('front.user.getPostForm') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="post-form p-3 border rounded">
                  <!-- Post Title -->
                  <input name="title" type="text" id="postTitle" class="form-control mb-2" placeholder="Post Title" />

                  <!-- Post Content -->
                  <textarea id="postContent" name="desc" class="form-control mb-2" rows="3" placeholder="What's on your mind?"></textarea>

                  <!-- Image Upload -->
                  <input name="images[]" type="file" id="postImage" class="form-control mb-2" accept="image/*" multiple />
                  <div class="tn-slider mb-2">
                      <div id="imagePreview" class="slick-slider"></div>
                  </div>

                  <!-- Category Dropdown -->
                  <select id="postCategory" class="form-select mb-2" name="category_id">
                      <option value="" selected >Select Category</option>
                      @foreach ($categories as $category)
                      <option  value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                      </select>

                  <!-- Enable Comments Checkbox -->
                  <label class="form-check-label mb-2">
                      <input name="comment_able" type="checkbox" class="form-check-input" /> Enable Comments
                  </label><br>

                  <!-- Post Button -->
                  <button type="submit" class="btn btn-primary post-btn">Post</button>
              </div>
             </form>
          </section>

          <!-- Posts Section -->
          <section id="posts" class="posts-section">
              <h2>Recent Posts</h2>
              <div class="post-list">
                @forelse ($posts as $post)

                  <!-- Post Item -->
                  <div class="post-item mb-4 p-3 border rounded">
                      <div class="post-header d-flex align-items-center mb-2">
                          <img src="{{ asset(auth()->user()->image) }}" alt="User Image" class="rounded-circle" style="width: 50px; height: 50px;" />
                          <div class="ms-3">
                              <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                              <small class="text-muted">2 hours ago</small>
                          </div>
                      </div>
                      <h4 class="post-title">{{ $post->title }}</h4>
                      <p class="post-content">{{ $post->desc }}</p>

                      <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                          <ol class="carousel-indicators">
                              <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                              <li data-target="#newsCarousel" data-slide-to="1"></li>
                              <li data-target="#newsCarousel" data-slide-to="2"></li>
                          </ol>
                          <div class="carousel-inner">
                            @foreach ($post->images as $image)
                            <div class="carousel-item  @if ($loop->index == 0) active @endif">
                                <img src="{{ asset($image->path ) }}" class="d-block w-100" alt="First Slide">
                                <div class="carousel-caption d-none d-md-block">
                                    {{-- <h5>dsfdk</h5>
                                    <p>
                                        oookok
                                    </p> --}}
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
                      </div>

                      <div class="post-actions d-flex justify-content-between">
                          <div class="post-stats">
                              <!-- View Count -->
                              <span class="me-3">
                                  <i class="fas fa-eye"></i> 123 views
                              </span>
                          </div>

                          <div>
                              <a href="{{ route('front.user.post.edit',$post->slug) }}" class="btn btn-sm btn-outline-primary">
                                  <i class="fas fa-edit"></i> Edit
                              </a>
                              <a href="" class="btn btn-sm btn-outline-primary">
                                  <i class="fas fa-thumbs-up"></i> Delete
                              </a>
                              <button id="getComments" class="btn btn-sm btn-outline-secondary">
                                  <i class="fas fa-comment"></i> Comments
                              </button>
                          </div>
                      </div>

                        <!-- Display Comments -->
                        <div class="comments" style="display: none" id="disblay_{{ $post->id }}"    >
                              <div class="comment">
                                  <img src="{{ asset(auth()->user()->image) }}" alt="User Image" class="comment-img" />
                                  <div class="comment-content">
                                      <span class="username"></span>
                                      <p class="comment-text">first comment</p>
                                  </div>
                              </div>
                          <!-- Add more comments here for demonstration -->
                         </div>
                  </div>

                  <!-- Add more posts here dynamically -->
                @empty
                    <div class="alert alert-info">
                        <h2>posts is empty</h2>
                    </div>
                @endforelse
              </div>
          </section>
      </section>
  </div>
</div>
<!-- Profile End -->
@endsection
@push('js')
<script>



    $(function(){

        $("#postImage").fileinput({
            theme: 'fa5',
            maxFileCount: 5,
            allowedFileTypes: ['image'],
            showUpload: false,
            showCancel:false,
        });
        $("#postContent").summernote({
            height: 300,
        });
    });





</script>
@endpush
