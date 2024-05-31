@extends("Layout",["title"=>"Favorites Page"])

@section("body")

<link rel="stylesheet" href="{{ asset('css/Favorites.css')}}">

    <?php
        $content = "
        <div class='header-bottom'>
        <div class='container'>

        <h3>
          ".Auth::user()->name."
        </h3>

        <nav class='navbar' data-navbar>

          <div class='navbar-top'>

            <a href='#' class='logo'>
              <img src='/images/logo.png' alt='Homeverse logo'>
            </a>

            <button class='nav-close-btn' data-nav-close-btn aria-label='Close Menu'>
              <ion-icon name='close-outline'></ion-icon>
            </button>

          </div>

          <div class='navbar-bottom'>
            <ul class='navbar-list'>


            </ul>
          </div>

        </nav>

        <div class='header-bottom-actions'>


    


      
          <a href='/User' class='btn btn-primary' >Back</a>
        </div>

      </div>
        ";  
    ?>

    <header>
        @include("Parts.Header",["content"=>$content])
    </header>
    <main>
        <div class="Favoris" id="articles">
            <h2 class="main-title">Favorites</h2>
            <div class="container">
                @for($i=0;$i < 6;$i++)
                    <div class="box">
                        <div class="border-fav">
                            <i class='bx bxs-bookmark'></i>
                            <img src="/images/houses/house_1.jpg">
                        </div>
                        <div class="content">
                            <div class="fav">
                                <h3>Test Title</h3>
                                <i class='bx bx-x'></i>
                            </div>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Reprehenderit</p>
                            <button class="btn btn-primary w-100 mt-2">Add To Cart</button>
                        </div>
                        <div class="info">
                            <a href="">Read More</a>
                            <i class="bx bx-right-arrow-alt"></i>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </main>

@endsection