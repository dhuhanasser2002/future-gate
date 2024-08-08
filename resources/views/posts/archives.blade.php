@extends('layouts.app')

@section('title','Archived Posts')

@section('content')

<section class="light">
    <div class="container py-2">
        <a href="{{ route('posts.index') }}" class="btn btn-primary btn-sm mb-5" style="margin-top:20px ">Bach To Posts</a>
        <div class="h1 text-center text-dark" id="pageHeaderTitle">Archived Posts</div>
            @foreach( $asrchivedPosts as $index => $post)
            @php
            // تحديد النمط بناءً على الفهرس
            $cardClass = $index % 2 === 0 ? 'blue' : 'red';
            @endphp
            
        <article class="postcard light {{ $cardClass }}">
            <a class="postcard__img_link" href="#">
                @if($post->image)
                <img class="postcard__img" src="{{ asset('images/' . $post->image) }}" alt="{{ $post->title }}" />
                @endif
            </a>
            <div class="postcard__text t-dark">
                <div>
                    @if ($post->user->image)
                    <img style="display:inline"
                        src="{{ asset('images/' . $post->user->image) }}"
                        class="rounded-circle border border-3" alt="user image" width="30px" height="30px">
                    @endif
                    <p style="display:inline">{{ $post->user->username }}</p>
                </div>
                <div class="postcard__subtitle small" style="margin-top: 10px">
                    <time datetime="{{ $post->created_at }}">
                        @if($post->updated_at != $post->created_at)
                        <i class="fas fa-calendar-alt mr-2"></i>{{ $post->created_at->format('D, M jS Y') }}
                        @else
                        <i class="fas fa-calendar-alt mr-2"></i>{{ $post->updated_at->format('D, M jS Y') }}
                        @endif
                    </time>
                </div>
                <div class="postcard__bar"></div>
                <div class="postcard__preview-txt">{{ $post->postContent }}</div>
               <div>
                  @foreach($post->tags as $tag)
                   <span  style="color: blue ; display:inline">#{{$tag->name}}</span>
                  @endforeach
               </div>
                <ul class="postcard__tagbox">
                <div class="element">
                    @php
                    $userReaction = $post->reactions->where('user_id', Auth::id())->first();
                    @endphp
        
                        <form action="{{ route('posts.react', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" name="type" value="like" style="background:none; border:none; color:#7388ff;">
                                <i class="{{ $userReaction && $userReaction->type == 'like' ? 'fa-solid' : 'fa-regular' }} fa-thumbs-up"></i> {{ $post->reactions->where('type', 'like')->count() }}
                            </button>
                        </form>
                        <!-- Button trigger modal -->
                        <a type="button" class="" data-bs-toggle="modal"
                            data-bs-target="#commentsModal{{ $post->id }}"><i class="fa-solid fa-comment"></i>
                        </a>
                        <form action="{{ route('posts.react', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" name="type" value="dislike" style="background:none; border:none; color:#7388ff;">
                            <i class="{{ $userReaction && $userReaction->type == 'dislike' ? 'fa-solid' : 'fa-regular' }} fa-thumbs-down"></i> {{ $post->reactions->where('type', 'dislike')->count() }}
                            </button>
                        </form>
                    </div>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="commentsModal{{ $post->id }}" data-bs-backdrop="static"
                         data-bs-keyboard="false" tabindex="-1" aria-labelledby="commentsModalLabel{{ $post->id }}"
                         aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="commentsModalLabel{{ $post->id }}">Comments</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @foreach ($post->comments as $comment)
                                    <div class="d-flex mb-3">
                                        @if ($comment->user->image)
                                            <img src="{{ asset('images/' . $comment->user->image) }}" class="rounded-circle border border-3 me-3" alt="user image" width="35px" height="35px">
                                        @else
                                            <img src="default-avatar.png" class="rounded-circle border border-3 me-3" alt="default user image" width="35px" height="35px">
                                        @endif
                                        <div class="flex-grow-1">
                                            <div class="bg-light p-2 rounded">
                                                <strong>{{ $comment->user->username }}</strong>
                                                <p class="mb-1">{{ $comment->content }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center mt-1">
                                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                <div class="d-flex align-items-center">
                                                    @if (auth()->check() && auth()->user()->can('update', $comment))
                                                        <a href="{{ route('comments.edit', $comment->id) }}" class="text-warning">
                                                            <i class="fas fa-edit fa-lg"></i>
                                                        </a>
                                                    @endif
                                                    @if (auth()->check() && auth()->user()->can('delete', $comment))
                                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn text-danger p-0 ms-2" onclick="return confirm('Are you sure you want to delete this comment?')">
                                                                <i class="fas fa-trash fa-lg"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                    
                                    <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-3 d-flex align-items-center">
                                        @csrf
                                        <div class="flex-shrink-0">
                                            @if (auth()->user()->image)
                                                <img src="{{ asset('images/' . auth()->user()->image) }}" class="rounded-circle border border-3 me-2" alt="user image" width="35px" height="35px">
                                            @else
                                                <img src="default-avatar.png" class="rounded-circle border border-3 me-2" alt="default user image" width="35px" height="35px">
                                            @endif
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="input-group">
                                                <textarea class="form-control" name="content" rows="1" placeholder="Write a comment..." required></textarea>
                                                <button type="submit" class="btn p-0 ms-2" style="background: none; border: none;">
                                                    <i class="fas fa-paper-plane fa-lg"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
                <div class="mt-2">
                    <form action="{{ route('posts.restore', $post->id) }}" method="POST"
                        style="display:inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-secondary  btn-sm" class="dropdown-item" style="margin-top: 10px">Unarchive</button>
                    </form>
                </div>
            </div>
        </article>

        @endforeach

    </div>
</section>


@endsection

