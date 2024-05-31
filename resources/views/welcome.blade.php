@extends('Layout',["title"=>"Welcome Page"])

@section('body')

    <?php
        $content = "
        <div class='header-bottom'>
        <div class='container'>

        <a href='#' class='logo'>
          <img src='/images/logo.png' alt='Homeverse logo'>
        </a>

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


          <button class='header-bottom-actions-btn' aria-label='Search'>
            <a href='#Recherche'>
              <ion-icon name='search-outline'></ion-icon>
            </a>
            <span>Search</span>
          </button>
          
          
            <a class='btn btn-outline-primary' href='/Login'>
              Log in  
            </a>
            
          

          <button class='d-none header-bottom-actions-btn' data-nav-open-btn aria-label='Open Menu'>
            <ion-icon name='menu-outline'></ion-icon>

            <span>Menu</span>
          </button>

        </div>

      </div>
        ";

        $etat = "disabled";
        $link = 'welcome';

    ?>


    <header>
        @include("Parts.Header",["content"=>$content])
    </header>

    <main>
        <div>
            @include("Parts.Landing")
        </div>
        <div>
            @include("Parts.Search")
        </div>
        <div>
            @include("Parts.Articles",["etat"=>$etat])
        </div>
        <div>
            @include("Parts.Contact")
        </div>
    </main>

    <footer>
        @include('Parts.Footer')
    </footer>



@endsection


