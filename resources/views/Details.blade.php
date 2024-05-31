@extends("Layout",["title"=>"Details Page"])

@section("body")

<link rel="stylesheet" href="{{ asset('css/Details.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />


    <main class="main-details">
        <div class="container">
            <div class="box">
                <div class="images">
                    @foreach ($Images as $key => $Image)
                    <div onclick="showImage('{{ asset($Image->path) }}')" class="img-holder {{ $key === 0 ? 'active' : '' }}">
                        <img src="{{ asset($Image->path) }}" alt="" >
                    </div>
                @endforeach     
                </div>
                <div class="basic-info">
                    <div class="d-flex">
                        <h1>{{$Offre->Category}}/</h1>
                        <h1 class="{{$Offre->Type_Offre === 'Purchase' ? 'text text-primary' :'text text-secondary' }}">
                            {{$Offre->Type_Offre}}
                            @if($Offre->Type_Offre === 'Purchase')
                            <i class="fas fa-shopping-cart"></i>
                            @else
                            <i class="fas fa-key"></i>
                            @endif
                        </h1>
                    </div>
                        <span>{{$Offre->Location}} / {{$Offre->Price}} DH</span>
                </div>
                <div class="description">
                    <p style="max-width: 400px; word-wrap: break-word;">{{$Offre->Descreption}}</p>
                    <div id='map' class="map" ></div>
                    <div style="width:100%">
                        <a class="btn btn-primary" href="javascript:history.back()">Back</a>
                        @if (Auth::user()->permision === "user")
                        <a class="btn btn-primary" href="#">Add to card</a>
                        @endif
                    </div>
                </div>

            </div>
        </main>
        <script src="{{ asset('js/Admin.js')}}"></script>

        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

        <script>
            var map = L.map('map').setView([31.7917, -7.0926], 7); // Default center coordinates for Morocco
        
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
        
            // Function to get coordinates based on selected location
            function getCoordinates(location) {
                var coordinates;
                switch (location) {
                    case 'Tanger-Tetouan-Al Hoceima':
                        coordinates = [35.7667, -5.8333];
                        break;
                    case 'Oriental':
                        coordinates = [34.6819, -1.9086];
                        break;
                    case 'Fès-Meknès':
                        coordinates = [34.0345, -5.0167];
                        break;
                    case 'Rabat-Salé-Kénitra':
                        coordinates = [34.0209, -6.8416];
                        break;
                    case 'Béni Mellal-Khénifra':
                        coordinates = [32.3333, -6.35];
                        break;
                    case 'Casablanca-Settat':
                        coordinates = [33.5333, -7.5833];
                        break;
                    case 'Marrakech-Safi':
                        coordinates = [31.6258, -7.9891];
                        break;
                    case 'Drâa-Tafilalet':
                        coordinates = [31.1837, -4.2361];
                        break;
                    case 'Souss-Massa':
                        coordinates = [30.4331, -9.6];
                        break;
                    case 'Guelmim-Oued Noun':
                        coordinates = [29.0000, -10.0000];
                        break;
                    case 'Laâyoune-Sakia El Hamra':
                        coordinates = [27.1536, -13.2033];
                        break;
                    case 'Dakhla-Oued Ed-Dahab':
                        coordinates = [23.6848, -15.9576];
                        break;
                    default:
                        coordinates = null;
                }
                return coordinates;
            }
        
            // Get coordinates for the specified location
            var coordinates = getCoordinates('{{$Offre->Location}}');
            if (coordinates) {
                map.setView(coordinates, 9); // Set zoom level to 7
            }

            L.marker(coordinates).addTo(map)
            .bindPopup('{{$Offre->Location}}').openPopup();
        </script>
        


@endsection
