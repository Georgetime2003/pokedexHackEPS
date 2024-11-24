<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonList;
use App\Http\Controllers\OpenAI;

Route::get('/', [PokemonList::class, 'getRandomPokemonIMGS'])->name('home');

Route::get('/pokedex', [PokemonList::class, 'index'])->name('pokedex');

Route::get('/pokemon/{id}', [PokemonList::class, 'getPokemonInfo'])->name('pokemon.show');

Route::get('/OpenAI/audio/{pokemonName}/{pokemonType}', [OpenAI::class, 'pokedexVoice'])->name('OpenAI.audio');