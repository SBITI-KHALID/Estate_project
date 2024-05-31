@extends('Layout',["title"=>"User Page"])

@section('body')

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

          <button class='header-bottom-actions-btn' aria-label='Search'>
            <a href='#Recherche'>
              <ion-icon name='search-outline'></ion-icon>
            </a>

            <span>Search</span>
          </button>


          <button data-bs-toggle='modal' data-bs-target='#UpdateUser' class='header-bottom-actions-btn' aria-label='Profile'>
            <ion-icon name='person-outline'></ion-icon>

            <span>Profile</span>
          </button>

          <button class='header-bottom-actions-btn' aria-label='Cart'>
            <ion-icon name='cart-outline'></ion-icon>

            <span>Cart</span>
          </button>

          <button class='header-bottom-actions-btn' aria-label='Favorites'>
            <a href='/Favorites'>
              <ion-icon name='heart-outline'></ion-icon>
            </a>


            <span>Favorites</span>
          </button>

          <button  data-bs-toggle='modal' data-bs-target='#message_Log_out' class='header-bottom-actions-btn' aria-label='Log out'>
            <ion-icon name='log-out-outline'></ion-icon>

            <span>Log out</span>
          </button>
          
          <button class='d-none header-bottom-actions-btn' data-nav-open-btn aria-label='Open Menu'>
            <ion-icon name='menu-outline'></ion-icon>

            <span>Menu</span>
          </button>
          
        </div>

      </div>
        ";  

        $etat = "";
        $link = 'User';
      
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
        <div id="Articles">
            @include("Parts.Articles",["etat"=>$etat])
        </div>
        <div id="Contact">
            @include("Parts.Contact")
        </div>
    </main>

    <footer>
        @include('Parts.Footer')
    </footer>

    <script src="{{ asset('js/User.js')}}"></script>
@endsection


<div class="modal fade" id="message_Log_out" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title"></h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
          <div class="modal-body">
              <h2 style="text-transform: lowercase;">Are you sure you want to log out ?</h2>
          </div>
          <div class="modal-footer">
            <a class="btn btn-outline-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
          </a>
          
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
          
          </div>
      </div>
  </div>
</div>

<div>
        

  <div class="modal fade pb-5 my-5" id="UpdateUser">
      <div class="modal-dialog modal-dialog-centered modal-lg my-5">
          <div class="modal-content">
              <div class="modal-header">
                  <h4 class="modal-title">Update your informations</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
              <div  class="modal-body d-flex justify-content-center mb-5">
                          <form  action="{{route('User.edit',Auth::user()->id)}}" method="HEAD" class="d-flex flex-column align-items-center justify-content-center">
                          @csrf
                          @method('put')
                          <div>
                              <label for="">Username</label>
                              <br>
                              <input style="text-transform: none" type="text" value="{{Auth::user()->name}}" name='name' class="form-control border-dark">
                          </div>
                          <div>
                              <label for="">Email</label>
                              <br>
                              <input style="text-transform: none"  type="email" name="new_email" value="{{Auth::user()->email}}" name='name'  class="form-control border-dark">
                          </div>
                          <div>
                              <label for="">Password</label>
                              <br>
                              <input style="text-transform: none"  type="text" name="New_password" class="form-control border-dark">
                          </div>
                          <div>
                              <label for="">Password Confirmation</label>
                              <br>
                              <input style="text-transform: none"  type="password" name="Password_Confirmation" class="form-control border-dark">
                          </div>
                          <div class="d-flex flex-column align-items-center justify-content-center hover-zoom">
                              <button class="btn btn-outline-primary mt-2">Edite </button>
                          </div>
                          @if(session('update_success'))
                          <div class="alert alert-success">{{ session('update_success') }}</div>
                          @endif
                      </form>
              </div>
          </div>
      </div>
  </div>