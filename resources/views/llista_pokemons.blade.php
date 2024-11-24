@extends('layout')
@section('head')
@csrf
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

@endsection
@section('content')
<!--<style>
  .header-pokedex {
    width : 100%;
    padding: 1em;
    background-color: red;
  }

  .fondo-pokedex {
    width: 100%;
    height: 100vh;
    background-color: 	#ad2609;
  }

  body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f8f8f8;
}

.curva-superior {
    width: 100%;
    height: 150px; /* Alçada de la curva */
    background: black;
    clip-path: path('M0,100 Q50,0 100,100 T200,100 T300,100 T400,100 T500,100 T600,100 T700,100 T800,100 T900,100 T1000,100 T1100,100 T1200,100 T1300,100 L1300,150 L0,150 Z');
}

.contingut {
    padding: 20px;
    text-align: center;
}
</style>-->
<script>
  window.onload = () => {
    document.getElementById('search').addEventListener('input', function() {
    const filter = this.value.toUpperCase();
    const table = document.getElementById('taulaPokemons');
    const tr = table.getElementsByTagName('tr');
    
    for (let i = 0; i < tr.length; i++) {
        const td = tr[i].getElementsByTagName('td')[1];
        if (td) {
            const textValue = td.textContent || td.innerText;
            tr[i].style.display = textValue.toUpperCase().includes(filter) ? '' : 'none';
        }
    }
    });
    document.querySelectorAll('tr[data-href]').forEach(item => {
      if (item.dataset.catched) {
        item.addEventListener('click', () => {
          window.location.href = item.dataset.href;
        });
        item.style.cursor = 'pointer';
      }
    });
  };
</script>

<style>
  .pokemon-name {
    font-size: 1.5em;
    font-weight: bold;
    text-transform: capitalize;
  }

  .bg-uknown {
    background-color: #68A090;
    color: white;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-normal {
    background-color: #A8A878;
    color: black;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-fire {
    background-color: #F08030;
    color: white;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-water {
    background-color: #6890F0;
    color: white;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-grass {
    background-color: #78C850;
    color: white;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-electric {
    background-color: #F8D030;
    color: black;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-ice {
    background-color: #98D8D8;
    color: black;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-fighting {
    background-color: #C03028;
    color: white;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-poison {
    background-color: #A040A0;
    color: white;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-ground {
    background-color: #E0C068;
    color: black;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-flying {
    background-color: #A890F0;
    color: black;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-psychic {
    background-color: #F85888;
    color: white;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-bug {
    background-color: #A8B820;
    color: black;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-rock {
    background-color: #B8A038;
    color: white;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-ghost {
    background-color: #705898;
    color: white;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-dragon {
    background-color: #7038F8;
    color: white;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-dark {
    background-color: #705848;
    color: white;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-steel {
    background-color: #B8B8D0;
    color: black;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }

  .bg-fairy {
    background-color: #EE99AC;
    color: black;
    margin: 2px;
    border-radius: 2px;
    text-align: center;
    text-transform: capitalize;
  }
  .pokemon-nocaught {
    background-color: #f8f9fa;
    color: #6c757d;
    border: 1px solid #6c757d;
    pointer-events: none;
  }

  .nameCapitalize {
    text-transform: capitalize;
  }
</style>

<h1 class="text-center pt-4">Pokedex</h1>


<div class="container">
  
  <div class="pb-5 px-2 pt-3">
    <div>
      <form action="{{-- {{ route('pokemon.search') }} --}}" method="GET" class="d-flex">
        <input class="form-control me-2" id="search" type="search" placeholder="Search for a Pokémon" aria-label="Search" name="query">
      </form>
    </div>
  </div>
  <table id="taulaPokemons" class="table table-hover">
    <thead class="table-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Imatge</th>
        <th scope="col">Nom</th>
        <th scope="col">Tipus</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($pokemons as $pokemon)
        @if ($pokemon['catched'])
        <tr data-catched="{{$pokemon['catched']}}" data-href="{{ route('pokemon.show', $pokemon['id']) }}">
            <th scope="row">{{ $pokemon['id'] }}</th>
            <td>
              <img src="{{$pokemon['image']}}" alt="{{$pokemon['name']}}" class="card-img-top" style="width: 40px; height: 40px;">
            </td>
            <td class="nameCapitalize">
              {{ $pokemon['name'] }}
            </td>
            <td>
              <span class="bg-{{ $pokemon['type1']}}">
                {{ $pokemon['type1']}}
              </span>
              <span class="bg-{{ $pokemon['type2']}}">
                {{ $pokemon['type2']}}
              </span>
            </td>
        </tr>
        @else
          <tr>
            <th scope="row">{{ $pokemon['id'] }}</th>
            <td>
              <img src="{{ asset('images/uncaught.png') }}" alt="uncaught" class="card-img-top" style="width: 40px; height: 40px;">
            </td>
            <td>
              ???????
            </td>
            <td>
              <span class="bg-uknown">
                ??????
              </span>
              <span class="bg-uknown">
                ??????
              </span>
            </td>
          </tr>
        @endif
      @endforeach
    </tbody>
  </table>
</div>