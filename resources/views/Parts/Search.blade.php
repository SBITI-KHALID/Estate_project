<link rel="stylesheet" href="{{ asset('css/Parts.css/Search.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<form class="recherche" action="{{route('Offres.index')}}" method="GET">
    @csrf
    @method('get')
    <input type="hidden" value="{{$link}}" name="hidden">
    <div class="home-bottom">
        <div class="container">
            <div  class="box-home-bottom  border-0">
                <select name="Location" class="form-select border-0 py-3 w-100 custom-select-outline">
                        <option selected >Location</option>
                        <option value="Tanger-Tetouan-Al Hoceima">Tanger-Tetouan-Al Hoceima</option>
                        <option value="Oriental">Oriental</option>
                        <option value="Fès-Meknès">Fès-Meknès</option>
                        <option value="Rabat-Salé-Kénitra">Rabat-Salé-Kénitra</option>
                        <option value="Béni Mellal-Khénifra">Béni Mellal-Khénifra</option>
                        <option value="Casablanca-Settat">Casablanca-Settat</option>
                        <option value="Marrakech-Safi">Marrakech-Safi</option>
                        <option value="Drâa-Tafilalet">Drâa-Tafilalet</option>
                        <option value="Souss-Massa">Souss-Massa</option>
                        <option value="Guelmim-Oued Noun">Guelmim-Oued Noun</option>
                        <option value="Laâyoune-Sakia El Hamra">Laâyoune-Sakia El Hamra</option>
                        <option value="Dakhla-Oued Ed-Dahab">Dakhla-Oued Ed-Dahab</option>
                </select>
            </div>
            <div  class="box-home-bottom  border-0">
                <input name="Category" placeholder="Category" class="form-select border-0 py-3 w-100 custom-select-outline" type="text" list="regions">
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
            <div class="box-home-bottom">
                <select name='search_with_offers'  class="form-select border-0 py-3 w-100 custom-select-outline">
                    <option selected value="all_offers">All offers</option>
                    <option value="Purchase" class="text text-primary">Purchase</option> <!-- Achat -->
                    <option value="Rental" class="text text-secondary">Rental</option> <!-- location -->
                </select>
            </div>
            <div class="box-home-bottom">
                <div class="btn-group w-100 h-100">
                    <button class="btn btn-light dropdown-toggle form-controle border-0 py-3 w-100 custom-select-outline" type="button" id="dropdownMenuClickable" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
                      Range of Price
                    </button>
                    <ul class="dropdown-menu px-2" aria-labelledby="dropdownMenuClickable">
                      <li class="input-group mb-1">
                        <span class="input-group-text"  id="basic-addon1">Max</span>
                        <input class="form-control" name='search_with_maximum_price' type="number" value="{{$MaxPrice}}" max="{{$MaxPrice}}" placeholder="Max">
                      </li>
                      <li class="input-group">
                        <span class="input-group-text" id="basic-addon1">Min</span>
                        <input class="form-control" name='search_with_minimum_price' type="number" value="{{$MinPrice}}" min='{{$MinPrice}}' placeholder="Min">
                      </li>
                    </ul>
                  </div>
            </div>
            <div class="box-home-bottom">
                <button type="submit" class="btn btn-primary border-0 w-100 py-3"><i class="fas fa-search"></i>
            </div>
        </div>
    </div>
    </div>


</form>
<br>
<br>
<br>
<br>

<!------------------------------------------------------------------------------------------------->

