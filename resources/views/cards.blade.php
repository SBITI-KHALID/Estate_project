<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cards</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   
    <link rel="stylesheet" href="{{ asset('css/Parts.css/Articles.css') }}">
</head>
<body>
    
<div class="container my-4">
    <h2 class="main-title text-primary">Your Cards</h2>
    <div class="row">
        @foreach($cards as $card)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if ($card->offre && $card->offre->images->isNotEmpty())
                    @php
                        $image = $card->offre->images->first();
                    @endphp
                    <img src="{{ asset($image->path) }}" class="card-img-top" alt="Image ID: {{ $image->id }}">
                @else
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image Available">
                @endif
                <div class="card-body">
                    @if ($card->offre)
                        <h5 class="card-title">Description</h5>
                        <p class="card-text">{{ $card->offre->Descreption }}</p>
                        <p class="card-text"><strong>Price:</strong> ${{ $card->offre->Price }}</p>
                    @else
                        <p class="card-text">No offre available for this card.</p>
                    @endif
                </div>
                <div class="card-footer">
                    <small class="text-muted">User ID: {{ $card->user_id }}</small>
                    <br>
                    <small class="text-muted">Offre ID: {{ $card->offre_id }}</small>
                    <form action="{{route('cards.destroy',$card->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-info">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>



</body>
</html>
