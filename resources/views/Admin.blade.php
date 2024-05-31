@extends('Layout',["title"=>"Admin Page"])

@section("body")

<link rel="stylesheet" href="{{ asset('css/Admin.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<?php
        $content = "
        <div class='header-bottom' style='margin-top:-10px;'>
        <div class='container'>

        <a href='#' class='logo'>
          <img src='/images/logo.png' alt='Homeverse logo'>
        </a>

        <nav class='navbar'  data-navbar>

          <div class='navbar-top' >

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

            <button data-bs-toggle='modal' data-bs-target='#UpdateUser' class='header-bottom-actions-btn' aria-label='Profile'>
            <ion-icon name='person-outline'></ion-icon>

            <span>Profile</span>
          </button>

          <button  data-bs-toggle='modal' data-bs-target='#message_Log_out' class='header-bottom-actions-btn' aria-label='Log out'>
            <ion-icon name='log-out-outline'></ion-icon>

            <span>Log out</span>
          </button>

          <button class='btn btn-primary btn-custom newUser' data-bs-toggle='modal' data-bs-target='#userForm'>Add new offer</button>


        </div>
    

      </div>
        ";
        $link = 'Admin';
?>

<header>
    @include("Parts.Header",["content"=>$content])
</header>

<main class="main-admin">
    <div>
        @include("Parts.Landing")
    </div>
    <div>
        @include("Parts.Search")
    </div>
    <div>
        <div class="mx-5">
            <h2 class="main-title">Offers</h2>
            <div class="row">
                <div class="col-12" style="overflow-y:scroll" >
                    <table style="min-width:1000px;;" class="table table-striped table-hover mt-3">
                        <thead class="text-center">
                            <tr id="Articles" class="table-primary">
                                <th>Proprietaire</th>
                                <th>Telephon</th>
                                <th>Location</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Type of offer</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="data">
                        @foreach($Offres as $Offre)
                            <tr>
                                <th class="text-center">{{$Offre->Proprietaire}}</th>
                                <th class="text-center">{{$Offre->tel}}</th>
                                <th class="text-center">{{$Offre->Location}}</th>
                                <th class="text-center">{{$Offre->Category}}</th>
                                <th class="text-center">{{$Offre->Price}} DH</th>
                                <th class="text-center {{$Offre->Type_Offre === 'Purchase' ? 'text text-primary' :'text text-secondary' }}">
                                    {{$Offre->Type_Offre}}
                                    @if($Offre->Type_Offre === 'Purchase')
                                    <i class="fas fa-shopping-cart"></i>
                                    @else
                                    <i class="fas fa-key"></i>
                                    @endif
                                </th>
                                <td class="d-flex justify-content-center align-items-center">
                                    <a class="btn btn-outline-primary mx-1 " href="{{ route("Offres.show", $Offre->id) }}"><i class="fas fa-info-circle"></i></a>
                                    <div>
                                        <button class=" btn btn-outline-warning" data-bs-toggle='modal' data-bs-target="#update{{ $Offre->id }}" ><i class="fas fa-pencil-alt"></i></button>
                                        <div class="modal fade pb-5 my-5" id="update{{ $Offre->id }}">
                                            <div class="modal-dialog modal-dialog-centered modal-lg my-5">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Update the offer</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <form action="{{ route('Offres.update', $Offre->id) }}" id="updateForm{{ $Offre->id }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                           <!-- Form fields similar to create form -->
                                                           <div class="text-center">
                                                               <label  class="custom-file-upload">
                                                                  <i class="bi bi-cloud-arrow-up"></i> Upload Image
                                                                 <input type="file" multiple name="images" onchange="previewImages(event,'previewContainer')">
                                                        </label>
                                                         </div>
                                                         <div style="height: 250px;overflow-x:scroll;box-shadow:inset 0 0 5px 0 black;" class="text-center mt-3 py-3" >
                                                             @foreach ($Images as $Image)
                                                                 @if ($Image->id_offer === $Offre->id)
                                                                     <img class="m-1" style="width: 200px;cursor:pointer;" src="{{$Image->path}}" onclick="showBiggerImage(this.src)" alt="Description of the image">
                                                                 @endif
                                                             @endforeach
                                                            </div>
                                                            <div class="text-center" id="previewContainer">
                                                                <!-- Image previews will be added here -->
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="Proprietaire" class="form-label">Proprietaire:</label>
                                                                <input class="form-control" value="{{ $Offre->Proprietaire }}" type="text" name="Proprietaire" id="Proprietaire">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tel" class="form-label">Telephon:</label>
                                                                <input class="form-control" value="{{ $Offre->tel }}" type="text" minlength="10" maxlength="14" name="tel" id="tel">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="Location" class="form-label">Location:</label>
                                                                <select class="form-control" name="Location" id="Location" onchange="updateMap(this.value)">
                                                                    <option {{ $Offre->Location == 'Tanger-Tetouan-Al Hoceima' ? 'selected' : '' }} value="Tanger-Tetouan-Al Hoceima">Tanger-Tetouan-Al Hoceima</option>
                                                                    <option {{ $Offre->Location == 'Oriental' ? 'selected' : '' }} value="Oriental">Oriental</option>
                                                                    <option {{ $Offre->Location == 'Fès-Meknès' ? 'selected' : '' }} value="Fès-Meknès">Fès-Meknès</option>
                                                                    <option {{ $Offre->Location == 'Rabat-Salé-Kénitra' ? 'selected' : '' }} value="Rabat-Salé-Kénitra">Rabat-Salé-Kénitra</option>
                                                                    <option {{ $Offre->Location == 'Béni Mellal-Khénifra' ? 'selected' : '' }} value="Béni Mellal-Khénifra">Béni Mellal-Khénifra</option>
                                                                    <option {{ $Offre->Location == 'Casablanca-Settat' ? 'selected' : '' }} value="Casablanca-Settat">Casablanca-Settat</option>
                                                                    <option {{ $Offre->Location == 'Marrakech-Safi' ? 'selected' : '' }} value="Marrakech-Safi">Marrakech-Safi</option>
                                                                    <option {{ $Offre->Location == 'Drâa-Tafilalet' ? 'selected' : '' }} value="Drâa-Tafilalet">Drâa-Tafilalet</option>
                                                                    <option {{ $Offre->Location == 'Souss-Massa' ? 'selected' : '' }} value="Souss-Massa">Souss-Massa</option>
                                                                    <option {{ $Offre->Location == 'Guelmim-Oued Noun' ? 'selected' : '' }} value="Guelmim-Oued Noun">Guelmim-Oued Noun</option>
                                                                    <option {{ $Offre->Location == 'Laâyoune-Sakia El Hamra' ? 'selected' : '' }} value="Laâyoune-Sakia El Hamra">Laâyoune-Sakia El Hamra</option>
                                                                    <option {{ $Offre->Location == 'Dakhla-Oued Ed-Dahab' ? 'selected' : '' }} value="Dakhla-Oued Ed-Dahab">Dakhla-Oued Ed-Dahab</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="Category" class="form-label">Category:</label>
                                                                <input value="{{$Offre->Category}}" placeholder="Category" name="Category" id="Category" class="form-select border-0 py-3 w-100 custom-select-outline" type="text" list="regions">
                                                                <datalist id="regions">
                                                                    <option value="Villa">
                                                                        <option value="House">
                                                                        <option value="Apartment">
                                                                        <option value="Condo">
                                                                        <option value="Townhouse">
                                                                        <option value="Cottage">
                                                                        <option value="Mansion">
                                                                        <option value="Bungalow">
                                                                        <option value="Farmhouse">
                                                                        <option value="Chalet">
                                                                        <option value="Duplex">
                                                                        <option value="Studio">
                                                                        <option value="Penthouse">
                                                                        <option value="Loft">
                                                                        <option value="Castle">
                                                                        <option value="Beach House">
                                                                        <option value="Ranch">
                                                                        <option value="Mobile Home">
                                                                        <option value="Treehouse">
                                                                </datalist>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="Price" class="form-label">Price:</label>
                                                                <div name="Price" class="input-group">
                                                                    <input name="Price" type="number" value="{{ $Offre->Price }}" class="form-control" id="Price" placeholder="Enter price" aria-label="Price" aria-describedby="basic-addon2">
                                                                    <span class="input-group-text">DH</span>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="Type_Offre" class="form-label">Type of offer:</label>
                                                                <select name="Type_Offre" class="form-select" id="Type_Offre">
                                                                    <option selected>Choose category</option>
                                                                    <option value="Purchase" {{ $Offre->Type_Offre == 'Purchase' ? 'selected' : '' }}>Purchase</option>
                                                                    <option value="Rental" {{ $Offre->Type_Offre == 'Rental' ? 'selected' : '' }}>Rental</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="Descreption" class="form-label">Descreption:</label>
                                                                <textarea class="form-control" name="Descreption" id="Descreption" cols="30" rows="10">{{ $Offre->Descreption }}</textarea>
                                                            </div>
                                                            <!-- autres champs du formulaire -->
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" form="updateForm{{ $Offre->id }}" class="btn btn-primary submit">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form class=" mx-1" action="{{ route('Offres.destroy', $Offre->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <!--Modal Form-->
    <div class="modal fade pb-5 my-5" id="userForm">
        <div class="modal-dialog modal-dialog-centered modal-lg my-5">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Fill the Form</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('Offres.store') }}" id="createForm" method="POST" enctype="multipart/form-data" >
                        @csrf
                        @method('post')
                        <div class="text-center">
                            <label for="imgInput" class="custom-file-upload">
                                <i class="bi bi-cloud-arrow-up"></i> Upload Image
                                <input type="file" multiple name="images[]" id="imgInput" onchange="previewImages(event, 'previewContainer1')">
                            </label>
                        </div>
                        <div class="text-center mt-3" id="previewContainer1">
                            <!-- Image previews will be added here -->
                        </div>
                        <div class="mb-3">
                            <label for="Proprietaire" class="form-label">Proprietaire:</label>
                            <input class="form-control" type="text" name="Proprietaire" id="Proprietaire">
                        </div>
                        <div class="mb-3">
                            <label for="tel" class="form-label">Telephon:</label>
                            <input class="form-control" type="text" minlength="10" maxlength="14" name="tel" id="tel">
                        </div>
                        <div class="mb-3">
                            <label for="Location" class="form-label">Location:</label>
                            <select class="form-control"  name="Location" id="Location" onchange="updateMap(this.value)">
                                <option  value="Tanger-Tetouan-Al Hoceima">Tanger-Tetouan-Al Hoceima</option>
                                <option value="Oriental">Oriental</option>
                                <option  value="Fès-Meknès">Fès-Meknès</option>
                                <option  value="Rabat-Salé-Kénitra">Rabat-Salé-Kénitra</option>
                                <option value="Béni Mellal-Khénifra">Béni Mellal-Khénifra</option>
                                <option value="Casablanca-Settat">Casablanca-Settat</option>
                                <option  value="Marrakech-Safi">Marrakech-Safi</option>
                                <option  value="Drâa-Tafilalet">Drâa-Tafilalet</option>
                                <option  value="Souss-Massa">Souss-Massa</option>
                                <option  value="Guelmim-Oued Noun">Guelmim-Oued Noun</option>
                                <option  value="Laâyoune-Sakia El Hamra">Laâyoune-Sakia El Hamra</option>
                                <option  value="Dakhla-Oued Ed-Dahab">Dakhla-Oued Ed-Dahab</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Category" class="form-label">Category:</label>
                                <input placeholder="Category" name="Category" id="Category" class="form-select border-0 py-3 w-100 custom-select-outline" type="text" list="regions">
                                <datalist id="regions">
                                    <option value="Villa">
                                        <option value="House">
                                        <option value="Apartment">
                                        <option value="Condo">
                                        <option value="Townhouse">
                                        <option value="Cottage">
                                        <option value="Mansion">
                                        <option value="Bungalow">
                                        <option value="Farmhouse">
                                        <option value="Chalet">
                                        <option value="Duplex">
                                        <option value="Studio">
                                        <option value="Penthouse">
                                        <option value="Loft">
                                        <option value="Castle">
                                        <option value="Beach House">
                                        <option value="Ranch">
                                        <option value="Mobile Home">
                                        <option value="Treehouse">
                                </datalist>
                        </div>
                        <div class="mb-3">
                            <label for="Price" class="form-label">Price:</label>
                            <div name="Price" class="input-group">
                                <input name="Price" type="number" class="form-control" id="Price" placeholder="Enter price" aria-label="Price" aria-describedby="basic-addon2">
                                <span class="input-group-text">DH</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="Type_Offre" class="form-label">Type of offer:</label>
                            <select name="Type_Offre" class="form-select" id="Type_Offre">
                                <option selected>Choose category</option>
                                <option value="Purchase">Purchase</option>
                                <option value="Rental">Rental</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="Descreption" class="form-label">Descreption:</label>
                            <textarea class="form-control" name="Descreption" id="Descreption" cols="30" rows="10"></textarea>
                        </div>
                        <!-- autres champs du formulaire -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
      </div>

</main>


<script src="{{ asset('js/Admin.js')}}"></script>


@endsection
