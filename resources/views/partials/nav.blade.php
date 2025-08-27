<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Brand</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">

            @guest()
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('register')}}">Register</a></li>
            </ul>
            @endguest
            @auth()
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="{{route('profile.apartments.create')}}">
                            Создать обьявление
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{route('profile.bookmarks.index')}}">
                            Избранное
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{route('profile.index')}}">{{Auth::user()->name}}</a></li>
                </ul>
            @endauth
        </div>
    </div>
</nav>
