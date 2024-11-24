<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonList extends Controller
{
    private $api = 'https://hackeps-poke-backend.azurewebsites.net/';

    public function getRandomPokemonIMGS() {
        $pokemons = $this->getPokemons();
        $randomPokemons[] = $pokemons[rand(0, count($pokemons) - 1)];
        $randomPokemons[0] = $randomPokemons[0]['image'];
        $randomPokemons[] = $pokemons[rand(0, count($pokemons) - 1)];
        $randomPokemons[1] = $randomPokemons[1]['image'];
        $randomPokemons[] = $pokemons[rand(0, count($pokemons) - 1)];
        $randomPokemons[2] = $randomPokemons[2]['image'];
        $randomPokemons[] = $pokemons[rand(0, count($pokemons) - 1)];
        $randomPokemons[3] = $randomPokemons[3]['image'];
        $randomPokemons[] = $pokemons[rand(0, count($pokemons) - 1)];
        $randomPokemons[4] = $randomPokemons[4]['image'];
        $randomPokemons[] = $pokemons[rand(0, count($pokemons) - 1)];
        $randomPokemons[5] = $randomPokemons[5]['image'];
        $randomPokemons[] = $pokemons[rand(0, count($pokemons) - 1)];
        $randomPokemons[6] = $randomPokemons[6]['image'];
        $randomPokemons[] = $pokemons[rand(0, count($pokemons) - 1)];
        $randomPokemons[7] = $randomPokemons[7]['image'];
        return view('home', ['randomPokemons' => $randomPokemons]);
    }

    public function getPokemonInfo($id)
    {   
        $pokemonCatched = $this->getPokemonCatched();
        $pokeReq = $this->api . 'pokemons/' . $id;
        $response = Http::get($pokeReq);
        $pokemon = $response->json();

        /* if (isset($pokemon['evolves_to'])) {
            $pokemon = $this->getEvolutionChain($pokemon);
            return response()->json($pokemon);
        } */


        $pokemon['catched'] = $this->checkCatched($id,$pokemonCatched);
        if ($pokemon['catched']) {
            return view('pokemon', ['pokemon' => $pokemon]);
        } else {
            return redirect()->route('pokedex');
        }
/*        return response()->json($pokemon); */
    }

    public function index()
    {
        $pokemons = $this->getPokemons();
        return view('llista_pokemons', ['pokemons' => $pokemons]);
    }
    
    protected function checkCatched($id, $pokemonsCatched)
    {
        foreach($pokemonsCatched as $pokemonCatched) {
            if($pokemonCatched['pokemon_id'] == $id) {
                return true;
            }
        }
        return false;
        return $pokemonsCatched;
    }
    protected function getPokemons()
    {
        $pokemonsCatched = $this->getPokemonCatched();
        $pokeReq = $this->api . 'pokemons';
        $response = Http::get($pokeReq);

        $pokemons = [];
        foreach($response->json() as $pokemonR) {
            $pokemon['image'] = $pokemonR['image'];
            $pokemon['catched'] = $this->checkCatched($pokemonR['id'], $pokemonsCatched);
            $pokemon['id'] = $pokemonR['id'];
            $pokemon['name'] = $pokemonR['name'];
            if (count($pokemonR['types']) == 1) {
                $pokemon['type1'] = $pokemonR['types'][0]['type']['name'];
                $pokemon['type2'] = '';
            } else {
                $pokemon['type1'] = $pokemonR['types'][0]['type']['name'];
                $pokemon['type2'] = $pokemonR['types'][1]['type']['name'];
            }
            $pokemons[] = $pokemon;
        }

        return $pokemons;       
        
    }

    protected function getPokemonCatched()
    {
        $request = $this->api . 'teams/119f8619-cff7-4e3a-b956-553b9f2739ea';
        $response = Http::get($request);


        return $response->json()['captured_pokemons'];
    }

    /* protected function getEvolutionChain($pokemon){
        $pokeReq = $this->api . 'pokemons/' . $pokemon['id'];
        $response = Http::get($pokeReq);
        $evo = $response->json();
        if (isset($evo) && $evo['name'] == $pokemon['evolves_to']['name']) {
            $pokeReq = $this->api . 'pokemons/' . $evo['id'];
            $response = Http::get($pokeReq);
            $evo2 = $response->json();
            if (isset($evo2['evolves_to']) && $evo['evolves_to']['name'] == $evo2['name']) {
                $pokemon['evo2']['name'] = $evo2['name'];
                $pokemon['evo2']['id'] = $evo2['id'];
                $pokemon['evo2']['active'] = false;
                $pokemon['evo1']['name'] = $evo['name'];
                $pokemon['evo1']['id'] = $evo['id'];
                $pokemon['evo1']['active'] = false;
                $pokemon['evo0']['name'] = $pokemon['name'];
                $pokemon['evo0']['id'] = $pokemon['id'];
                $pokemon['evo0']['active'] = true;
            } else {
                $pokeReq = $this->api . 'pokemons/' . ($pokemon['id'] - 1);
                $response = Http::get($pokeReq);
                $evo2 = $response->json();
                if (isset($evo2['evolves_to']) && $evo2['evolves_to'] == $pokemon['name']) {
                    $pokemon['evo2']['name'] = $evo['name'];
                    $pokemon['evo2']['id'] = $evo['id'];
                    $pokemon['evo2']['active'] = false;
                    $pokemon['evo1']['name'] = $pokemon['name'];
                    $pokemon['evo1']['id'] = $pokemon['id'];
                    $pokemon['evo1']['active'] = true;
                    $pokemon['evo0']['name'] = $evo2['name'];
                    $pokemon['evo0']['id'] = $evo2['id'];
                    $pokemon['evo0']['active'] = false;
                }
            }
        } else {
            $pokeReq = $this->api . 'pokemons/' . ($pokemon['id'] - 1);
            $response = Http::get($pokeReq);
            $evo = $response->json();
            if (isset($evo) && isset($evo['evolves_to']) && $evo['evolves_to']['name'] == $pokemon['name']) {
                $pokeReq = $this->api . 'pokemons/' . ($pokemon['id'] - 2);
                $response = Http::get($pokeReq);
                $evo2 = $response->json();
                if (isset($evo2) && isset($evo2['evolves_to']) && $evo2['evolves_to']['name'] == $evo['name']) {
                    $pokemon['evo2']['name'] = $pokemon['name'];
                    $pokemon['evo2']['id'] = $pokemon['id'];
                    $pokemon['evo2']['active'] = true;
                    $pokemon['evo1']['name'] = $evo['name'];
                    $pokemon['evo1']['id'] = $evo['id'];
                    $pokemon['evo1']['active'] = false;
                    $pokemon['evo0']['name'] = $evo2['name'];
                    $pokemon['evo0']['id'] = $evo2['id'];
                    $pokemon['evo0']['active'] = false;
                } else {
                    $pokeReq = $this->api . 'pokemons/' . ($pokemon['id'] + 1);
                    $response = Http::get($pokeReq);
                    $evo2 = $response->json();
                    if (isset($evo2) && isset($evo2['evolves_to']) && $pokemon['evolves_to']['name'] == $evo2['name']) {
                        $pokemon['evo2']['name'] = $evo2['name'];
                        $pokemon['evo2']['id'] = $evo2['id'];
                        $pokemon['evo2']['active'] = false;
                        $pokemon['evo1']['name'] = $pokemon['name'];
                        $pokemon['evo1']['id'] = $pokemon['id'];
                        $pokemon['evo1']['active'] = true;
                        $pokemon['evo0']['name'] = $evo['name'];
                        $pokemon['evo0']['id'] = $evo['id'];
                        $pokemon['evo0']['active'] = false;
                    } else {
                        $pokemon['evo2']['name'] = null;
                        $pokemon['evo2']['id'] = null;
                        $pokemon['evo2']['active'] = false;
                        $pokemon['evo1']['name'] = $pokemon['name'];
                        $pokemon['evo1']['id'] = $pokemon['id'];
                        $pokemon['evo1']['active'] = true;
                        $pokemon['evo0']['name'] = $evo['name'];
                        $pokemon['evo0']['id'] = $evo['id'];
                        $pokemon['evo0']['active'] = false;
                    }
                }
            } else {
                $pokemon['evo2']['name'] = null;
                $pokemon['evo2']['id'] = null;
                $pokemon['evo2']['active'] = false;
                $pokemon['evo1']['name'] = null;
                $pokemon['evo1']['id'] = null;
                $pokemon['evo1']['active'] = false;
                $pokemon['evo0']['name'] = $pokemon['name'];
                $pokemon['evo0']['id'] = $pokemon['id'];
                $pokemon['evo0']['active'] = true;
            }
        }
        return $pokemon;
    } */
}
