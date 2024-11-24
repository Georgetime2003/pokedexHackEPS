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
    overflow-x: hidden; /* Evita desplazamiento horizontal */
    overflow-y: auto; /* Permite desplazamiento vertical */
    position: relative; /* Para controlar el stacking */
  }

  /* Título */
  .pokedex-title {
    font-size: clamp(3rem, 8vw, 7rem); /* Responsivo usando clamp */
    font-weight: bold;
    color: #ff0000;
    text-shadow: 3px 3px 5px #000;
    margin-bottom: 20px; /* Espacio más pequeño en pantallas pequeñas */
    text-align: center;
    z-index: 10;
  }

  /* Contenedor principal */
  .pokedex-container {
    text-align: center;
    padding: 20px;
    border-radius: 20px;
    background-color: rgba(255, 255, 255, 0.9); /* Más translúcido */
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
    max-width: 90%; /* Ajusta automáticamente al tamaño */
    width: 400px; /* Fija un ancho razonable */
    position: relative;
    z-index: 10;
  }

  /* Descripción */
  .pokedex-description {
    font-size: clamp(1rem, 2.5vw, 1.2rem); /* Responsivo */
    color: #333;
    margin-bottom: 20px;
  }

  /* Botón de entrada */
  .pokedex-btn {
    font-size: 1.5rem;
    padding: 12px 20px;
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
    width: 100px;
    height: 100px;
    opacity: 0;
    transition: opacity 2s, transform 2s;
    z-index: 1; /* Detrás del contenido principal */
  }

  /* Media Queries para ajustar todo */
  @media (max-width: 768px) {
    .pokedex-title {
      font-size: 5rem;
    }
    .pokedex-container {
      width: 90%; /* Más flexibilidad */
      padding: 15px;
    }
    .pokedex-btn {
      font-size: 1.2rem;
      padding: 10px 15px;
    }
  }

  @media (max-width: 480px) {
    .pokedex-title {
      font-size: 4rem;
    }
    .pokedex-container {
      padding: 10px;
    }
    .pokedex-btn {
      font-size: 1rem;
      padding: 8px 12px;
    }
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
  
      // Dimensiones del viewport (área visible)
      const viewportWidth = window.innerWidth;
      const viewportHeight = window.innerHeight;
  
      // Tamaño del Pokémon (aseguramos que no sea más grande que el área visible)
      const pokemonSize = Math.min(viewportWidth, viewportHeight) * 0.1; // 10% del menor lado
      img.style.width = `${pokemonSize}px`;
      img.style.height = `${pokemonSize}px`;
  
      // Posición aleatoria dentro del área visible
      const x = Math.random() * (viewportWidth - pokemonSize); // Evita desbordes horizontales
      const y = Math.random() * (viewportHeight - pokemonSize); // Evita desbordes verticales
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
