<style>
    .navbar {
        background-color: #000000;
        padding: 15px 30px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .navbar-brand {
        font-size: 1.8rem;
        font-weight: bold;
        color: #FFFFFF;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        transition: color 0.3s ease-in-out;
    }
    .navbar-brand:hover {
        color: #FF4D00;
    }
    .nav-link {
        color: #FFFFFF;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0 15px;
        position: relative;
        transition: color 0.3s ease-in-out;
    }
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 2px;
        background-color: #FF4D00;
        transition: width 0.3s ease-in-out;
    }
    .nav-link:hover {
        color: #FF4D00;
    }
    .nav-link:hover::after {
        width: 100%;
    }
    .navbar-toggler {
        border: none;
        color: #FFFFFF;
    }
    .navbar-toggler-icon {
        background-image: none;
        width: 25px;
        height: 2px;
        background-color: #FFFFFF;
        display: inline-block;
        position: relative;
    }
    .navbar-toggler-icon::before,
    .navbar-toggler-icon::after {
        content: '';
        background-color: #FFFFFF;
        width: 25px;
        height: 2px;
        position: absolute;
        left: 0;
        transition: transform 0.3s ease-in-out;
    }
    .navbar-toggler-icon::before {
        top: -8px;
    }
    .navbar-toggler-icon::after {
        top: 8px;
    }
</style>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <!-- Link "Home" that dynamically changes based on the user's authentication status -->
        @auth
            <a class="navbar-brand" href="{{ route('privada') }}">Home</a>
        @else
            <a class="navbar-brand" href="{{ route('home') }}">Home</a>
        @endauth

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth

                    

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">SignIn</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
