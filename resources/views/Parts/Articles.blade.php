<link rel="stylesheet" href="{{ asset("css/Parts.css/Articles.css")}}">

<div class="articles" id="articles">
    <h2 class="main-title">Articles</h2>
    <div class="container">
        @foreach($Offres as $Offre)
            <div class="box">
                @foreach ($Images as $key => $Image)
                @if ($Offre->id === $Image->id_offer)
                <div class="img-holder">
                    <div class="w-100 text text-end" style="position:relative;bottom:-5px;right:10px;">
                        <h1 style="text-shadow: .5px .5px 0px white" class="{{$Offre->Type_Offre === 'Purchase' ? 'text text-primary' :'text text-secondary' }}">
                            @if($Offre->Type_Offre === 'Purchase')
                            <i class="fas fa-shopping-cart"></i>
                            @else
                            <i class="fas fa-key"></i>
                            @endif
                        </h1>   
                    </div>
                    <img style="margin-top:-50px;" src="{{ asset($Image->path) }}" alt="">
                    </div>
                    @break
                @endif
            @endforeach
                <div class="content">
                    <div class="fav">
                            <h3>{{$Offre->Category}}</h3>
                            @if ($etat ==! 'disabled')
                                <i class='bx bx-heart' onclick="changeHeartColor(this)"></i>
                        @endif
                    </div>
                    <p>{{ \Illuminate\Support\Str::limit($Offre->Descreption, 80) }}</p>
                    <h4>{{$Offre->Price}} DH</h4>
                    @if ($etat === 'disabled')
                    <button  data-bs-toggle='modal' data-bs-target="#message" class="btn btn-primary w-100 mt-2" >Add To Cart</button>
                    @else
                    <button class="btn btn-primary w-100 mt-2" >Add To Cart</button>
                    @endif
                </div>
                <div class="info">
                    <a href="{{ route("Offres.show", $Offre->id) }}" >Read More</a>
                    <i class="bx bx-right-arrow-alt"></i>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="spikes"></div>


<div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
            <div class="modal-body">
                <h2 style="text-transform: lowercase;" >Please log in or create an account to access this feature.</h2>
            </div>
            <div class="modal-footer">
                
                <a type="button" href="/Login" class="btn btn-outline-primary" data-dismiss="modal">Log in</a>
            </div>
        </div>
    </div>
</div>
