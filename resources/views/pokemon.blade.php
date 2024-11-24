@extends('layout')
@section('head')
@endsection
@section('content')

<script>
  function playPokemonSound() {
    const audio = new Audio("{{ $pokemon['cries'] }}");
  
  // Reproduce el audio
    audio.play().catch(error => {
        console.error('Error al reproducir el audio:', error);
    });
  }

  window.onload = () => {
    getPokemonInfoSound();
  };

  function getPokemonInfoSound() {
    let pokemonName = "{{ $pokemon['name'] }}";
    let pokemonType = "{{ $pokemon['types'][0]['type']['name'] }}"@if(isset($pokemon['types'][1])) + " - " + "{{ $pokemon['types'][1]['type']['name'] }}"@endif;
    fetch(`/OpenAI/audio/${encodeURIComponent(pokemonName)}/${encodeURIComponent(pokemonType)}`, {
            method: 'GET',
            headers: {
                'Accept': 'audio/mpeg'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.blob();
        })
        .then(blob => {
            const audioUrl = URL.createObjectURL(blob);
            const audio = new Audio(audioUrl);

            const openAIMessage = document.getElementById('OpenAIMessage');
            if (openAIMessage) {
                openAIMessage.style.cursor = 'pointer';
                openAIMessage.addEventListener('click', () => {
                    //Check if the audio is already playing
                    if (audio.paused) {
                        audio.play().catch(error => {
                            console.error('Error al reproducir el audio:', error);
                        });
                    }
                });
            } else {
                console.error('Element with ID "OpenAIMessage" not found.');
            }
        })
        .catch(error => {
            console.error('Error en la solicitud fetch:', error);
        });
    }
</script>

<style>
  /* Asegurem que el cos ocupa tot l'alçada de la pantalla */
  .parent {
      height: 100vh;
      margin: 0;
      display: flex;
      justify-content: center; /* Centrar horitzontalment */
      align-items: center;     /* Centrar verticalment */
      background-color: #f0f0f0;
  }

  .capitalize {
    text-transform: capitalize;
  }

  .child {
      width: 350px;
      height: 700px;
      border: 3px solid black;
      border-radius: 15px;
      background-color: #db4f4f;
  }

  .info-pokemon {
    border-radius: 15px;
    border: 3px solid black;
    padding: 15px;
    margin-left: 15px;
    margin-right: 15px;
    background-color: #f0f0f0;
    height: 180px; /* Altura máxima de 180px */
    overflow-y: auto; /* Barra de desplazamiento si el contenido excede la altura */
  }

  .info-pokemon::-webkit-scrollbar {
  display: none; /* Ocultar en navegadores basados en WebKit */
  }

  .boto {
    width: 30px; /* Tamaño del círculo */
    height: 30px; /* Tamaño del círculo */
    border-radius: 50%; /* Hace que el borde sea circular */
    background-color: #BEBEBE; /* Color de fondo gris */
    border: 2px solid black; /* Borde negro */
    font-size: 24px; /* Tamaño de la icono dentro del círculo */
    cursor: pointer; /* Cambia el cursor para indicar que es interactivo */
    margin-right: 8px;
  }

  .boto:hover {
    background-color: #818181; /* Color de fondo gris */
  }

  /* Ejemplo de cómo usar la clase para insertar un icono usando FontAwesome */
  .boto i {
    color: black; /* Color del icono (negro en este caso) */
  }

</style>

<div class="parent">
  <div class="child">
    <div class="d-flex flex-row">
      <a href="{{ route('pokedex') }}">
        <img src="{{ asset('images/botopokedex.svg') }}" width="100" height="100" style="margin-left:25px; margin-right:20px; margin-top: 10px;" />
    </a>
      <img src="{{ asset('images/altresBotons.svg') }}" width="150" height="50" style="margin-left:0px; margin-top: 10px"/>
    </div>

    <svg height="60" width="100%" class="left-svg">
      <polyline
        points="0,40 200,40 230,10 600,10"
        style="fill: none; stroke: black; stroke-width: 3"
      />
    </svg>
    
    
    
    

    <svg xmlns="http://www.w3.org/2000/svg" width="340" height="300" viewBox="0 0 340 300">
      <!-- Fondo blanco con bordes redondeados -->
      <rect x="10" y="15" width="320" height="270" rx="18" ry="18" fill="#FFFFFF" stroke="#000000" stroke-width="2" />
      
      <!-- Zona gris de la pantalla -->
      <rect x="25" y="52" width="290" height="190" rx="15" ry="15" fill="#BEBEBE" />
      
      <!-- Imagen dentro de la zona gris -->
      <image x="95" y="52" width="150" height="190" href="{{ $pokemon['image'] }}" />
      
      <!-- Botones superiores pequeños -->
      <circle cx="170" cy="37" r="6" fill="#FF0000" />
      <circle cx="200" cy="37" r="6" fill="#FF0000" />
      
      <!-- Botón rojo inferior izquierdo -->
      <circle style="cursor: pointer;" onclick="playPokemonSound()" cx="35" cy="265" r="13" fill="#FF0000" stroke="#000000" stroke-width="1.5" />

      <circle style="cursor: nothing;" id="OpenAIMessage" cx="70" cy="265" r="13" fill="#4A90E2" stroke="#000000" stroke-width="1.5" />
      
      <!-- Rejillas inferiores derechas -->
      <rect x="260" y="253" width="50" height="3" fill="#000000" />
      <rect x="260" y="264" width="50" height="3" fill="#000000" />
      <rect x="260" y="275" width="50" height="3" fill="#000000" />
    </svg>
    
    
    
    
    
    <div class="info-pokemon">
      <div id="pg1" class="page active">
        <b>Id:</b> <span class="capitalize">{{ $pokemon['id'] }}</span>
        <br>
        <b>Nom:</b> <span class="capitalize">{{ $pokemon['name'] }}</span>
        <br>
        <b>Tipus:</b> <span class="capitalize">{{ $pokemon['types'][0]['type']['name'] }}</span>
        <br>
        <b>Alçada:</b> {{ $pokemon['height'] }}
        <br>
        <b>Pes:</b> {{ $pokemon['weight'] }}
        <br>
        <b>Evoluciona a:</b>
          @if($pokemon['evolves_to'] == null)
            <i>No té evolució</i>
          @else
            {{$pokemon['evolves_to']['name']}}
          @endif
      </div>
      <div id="pg2" class="page">
        <b>Habilitats:</b>
        <ul>
          @foreach ($pokemon['abilities'] as $ability)
            <li class="capitalize">{{ $ability['ability']['name'] }}</li>
          @endforeach
        </ul>
      </div>
      <div id="pg3" class="page">
        <b>Stats:</b>
        <ul>
          @foreach ($pokemon['stats'] as $stat)
              <li><b class="capitalize">{{ $stat['stat']['name'] }}</b>: {{ $stat['base_stat'] }}</li>
          @endforeach
        </ul>
      </div>
    </div>
    
    <div class="d-flex flex-row justify-content-end" style="margin-left: 15px; margin-right: 15px; font-size: 18px; margin-top: 7px;">
      <div class="d-flex flex-row">
        <div class="boto" id="prevPage">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
          </svg>
        </div>
        <div class="boto" id="nextPage">
          <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
          </svg>
        </div>
      </div>
    </div>
  </div>
</div>





<!--<pre> {{ var_dump($pokemon['evolves_to']) }} </pre>-->
<script>
function playPokemonSound() {
    // Asegúrate de envolver el valor en comillas dobles
    const audio = new Audio("{{ $pokemon['cries'] }}");

    // Reproduce el audio
    audio.play().catch(error => {
        console.error('Error al reproducir el audio:', error);
    });
}

function playPokemonDescripton() {
  // Asegúrate de envolver el valor en comillas dobles
  const audio = new Audio("");

  // Reproduce el audio
  audio.play().catch(error => {
      console.error('Error al reproducir el audio:', error);
  });
}


  // Selección de las páginas y botones
  const pages = document.querySelectorAll('.page');
  const prevButton = document.getElementById('prevPage');
  const nextButton = document.getElementById('nextPage');

  // Variable para controlar la página actual
  let currentPage = 0;

  // Función para actualizar la visibilidad de las páginas
  function updatePages() {
    pages.forEach((page, index) => {
      page.style.display = index === currentPage ? 'block' : 'none';
    });
  }

  // Evento para el botón de siguiente página
  nextButton.addEventListener('click', () => {
    if (currentPage < pages.length - 1) {
      currentPage++;
      updatePages();
    }
  });

  // Evento para el botón de página anterior
  prevButton.addEventListener('click', () => {
    if (currentPage > 0) {
      currentPage--;
      updatePages();
    }
  });

  // Inicialización: mostrar solo la primera página
  updatePages();

</script>
