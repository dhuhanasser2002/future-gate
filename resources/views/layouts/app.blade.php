<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Laravel Blog')</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

        <link rel="stylesheet" href="{{asset('/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('/css/newstyle.css')}}">
        <style>
            .note{
                position: relative;
            }
            .count{
                width: 100%;
                position: absolute;
                padding: 2px;
                border-radius: 50%;
                background-color: #ff5e62;
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                transform: translate(60% , -185%);
            }
        </style>
    </head>

    <body>
        <header>
            <nav class="navbar navbar-expand-lg fixed-top navbar-light  pl-5 pr-5" style="background-color: #e1e5ff;">
                <a class="navbar-brand pr-5" href="{{route('home')}}"><img src="{{asset('/images/logo.png')}}" alt="" width="70px"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse nav" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item active pr-5">
                            <a class="nav-link" href="{{ route('posts.index') }}"><i class="fa-solid fa-house"></i><span
                                    class="sr-only">(current)</span>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item active pr-5">
                            <a class="nav-link" href="{{ route('users.index') }}"><i
                                    class="fa-solid fa-circle-user"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item active pr-5">
                            <a class="nav-link" href="{{ route('categories.index') }}"><i
                                    class="fa-solid fa-layer-group"></i><span class="sr-only">(current)</span>
                                <p>Categories</p>
                            </a>
                        </li>
                        @if(auth()->check() && auth()->user()->is_admin)
                        <li class="nav-item active pr-5">
                            <a class="nav-link" href="{{ route('tags.index') }}"><i class="fa-solid fa-tags"></i><span
                                    class="sr-only">(current)</span>
                                <p>Tags</p>
                            </a>
                        </li>
                        @endif
                        @if(auth()->check() && auth()->user()->is_admin)
                           <li class="nav-item active pr-5">
                            <a class="nav-link" href="{{route('users.trash')}}"><i
                                    class="fa-solid fa-user-xmark"></i><span class="sr-only">(current)</span>
                                <p>Blocked Users</p>
                            </a>
                           </li>
                        @endif   
                        <li class="nav-item active pr-5">
                            <a class="nav-link" href="{{route('posts.trash')}}"><i
                                    class="fa-solid fa-box-archive"></i><span class="sr-only">(current)</span>
                                <p>Archived Posts</p>
                            </a>
                        </li>
                        @if(auth()->check() && !auth()->user()->is_student && !auth()->user()->is_admin)
                           <li class="nav-item active pr-5">
                            <a class="nav-link" href="{{ route('requests.create') }}">
                                <i class="fa-solid fa-paper-plane"></i> <!-- أيقونة إرسال طلب -->
                                <span class="sr-only">(current)</span>
                                <p>Add Request</p>
                            </a>
                          </li>
                       @endif
                        @if(auth()->check() && auth()->user()->is_admin)
                        <li class="nav-item active pr-5">
                            <a class="nav-link" href="{{route('requests.index')}}"><div class="note"><i class="fa-solid fa-bell"></i>
                            @if($studentrequest->count()>0)
                            <div class="count">{{$studentrequest->count()}}</div>
                            @endif
                        </div><span class="sr-only">(current)</span>
                                <p>Requests</p>
                            </a>
                        </li>
                        @endif
                        @if(auth()->check() && (auth()->user()->is_admin||auth()->user()->is_student) )
                        <li class="nav-item active pr-5">
                            <a class="nav-link" href="{{route('projects.index')}}"><i class="fa-solid fa-laptop-code"></i><span class="sr-only">(current)</span>
                                <p>Projects</p>
                            </a>
                        </li>
                        @endif
                        
                    </ul>
                    <ul class="navbar-nav ml-5">
                        <form class="form-inline my-2 my-lg-0" action="{{route('post.search')}}" method="GET">
                            <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search" aria-label="Search" style="background-color: #e1e5ff;" >
                            <button class=" my-2 my-sm-0 search" type="submit"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                        </form>
                        @auth
                        <!-- If user is authenticated, show logout link -->
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link"
                                    style="color: #7388ff; background-color : #e1e5ff;">Logout</button>
                            </form>
                        </li>
                        @else
                        <!-- If user is a guest, show login and register links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" style="background-color:  #e4e7fc;">Login</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </nav>
        </header>
        <main class="container-fluid" style="margin-top: 100px; padding: 0 50px">
            @yield('content')
        </main>
        <footer class="mt-4 text-center">
            <!-- Add your footer content here -->
        </footer>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.umd.min.js">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
        <script src="{{asset('/js/script.js')}}"></script>
    </body>

</html>