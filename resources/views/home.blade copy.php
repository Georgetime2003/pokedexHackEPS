@extends('layout-secondary')
@section('head')

@endsection
@section('content')
<style>
    /* Fondo de la página */
    body {
      background-color: #f0f8ff;
      background-image: linear-gradient(135deg, #f0f8ff 0%, #a2d9ff 100%);
      height: 100vh;
      margin: 0;
      font-family: 'Arial', sans-serif;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      overflow: hidden; /* Evita el scroll */
      position: relative; /* Necesario para z-index */
    }

    /* Título */
    .pokedex-title {
      font-size: 7rem; /* Más grande */
      font-weight: bold;
      color: #ff0000;
      text-shadow: 3px 3px 5px #000;
      margin-bottom: 40px; /* Espacio entre el título y el contenedor */
      text-align: center;
      position: relative; /* Garantiza que z-index funcione */
      z-index: 10;
    }

    /* Contenedor principal */
    .pokedex-container {
      text-align: center;
      padding: 30px;
      border-radius: 20px;
      background-color: rgba(255, 255, 255, 0.8); /* Translúcido */
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3); /* Sombra suave */
      max-width: 600px;
      width: 90%;
      position: relative; /* Garantiza que z-index funcione */
      z-index: 10;
    }

    /* Descripción */
    .pokedex-description {
      font-size: 1.2rem;
      color: #333;
      margin-bottom: 30px;
    }

    /* Botón de entrada */
    .pokedex-btn {
      font-size: 1.5rem;
      padding: 15px 30px;
      background-color: #ff0000;
      color: white;
      border: none;
      border-radius: 50px;
      transition: all 0.3s ease;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
      text-transform: uppercase;
      text-decoration: none;
    }

    .pokedex-btn:hover {
      background-color: #d00000;
      box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.3);
      transform: scale(1.1);
    }

    /* Pokémon animados */
    .pokemon {
      position: absolute;
      width: 120px;
      height: 120px;
      opacity: 0;
      transition: opacity 2s, transform 2s;
      z-index: 1; /* Detrás de todo */
    }
  </style>


  <!-- Título centrado arriba -->
  <h1 class="pokedex-title">Pokédex</h1>

  <!-- Contenedor centrado debajo del título -->
  <div class="pokedex-container">
    <!-- Descripción -->
    <p class="pokedex-description">
      ¡Bienvenido a la Pokédex! Explora el mundo Pokémon y descubre todo sobre ellos. Haz clic en el botón para empezar tu aventura.
    </p>
    <!-- Botón para entrar -->
    <a href="{{route('pokedex')}}" class="btn pokedex-btn">Entrar</a>
  </div>

  <!-- JavaScript para los Pokémon animados -->
  <script>
    // Array de URLs de imágenes de Pokémon
    const pokemonImages = [
      ...@json($randomPokemons)
    ];

    // Función para crear un Pokémon animado
    function createPokemon() {
      const img = document.createElement('img');
      img.src = pokemonImages[Math.floor(Math.random() * pokemonImages.length)];
      img.className = 'pokemon';

      // Posición aleatoria
      const x = Math.random() * window.innerWidth;
      const y = Math.random() * window.innerHeight;
      img.style.left = `${x}px`;
      img.style.top = `${y}px`;

      // Añadir al body
      document.body.appendChild(img);

      // Animación de aparición
      setTimeout(() => {
        img.style.opacity = 1;
        img.style.transform = `scale(${1 + Math.random() * 0.5})`;
      }, 100);

      // Eliminar después de 4 segundos
      setTimeout(() => {
        img.style.opacity = 0;
        img.style.transform = 'scale(0)';
        setTimeout(() => img.remove(), 2000);
      }, 4000);
    }

    // Crear un Pokémon cada segundo
    setInterval(createPokemon, 1000);
  </script>


@endsection

