<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OpenAI extends Controller
{
    private $apiAudioSpeech = 'https://api.openai.com/v1/audio/speech';
    private $apiCompletion = 'https://api.openai.com/v1/chat/completions';

    public function pokedexVoice($pokemonName, $pokemonType) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY')
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o-mini',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => 'You are a Pokedex. You are given the following information: Pokémon name and Pokémon types. Please provide a short description of the Pokemon. as this example: "(Pokemon name), Pokémon de tipus (Pokemon type). es un Pokemon (Descripcio relacionada que tu proporciones)". The description will be the pokedex description. Traslate it in catalan, included the types.'
                    ],
                    [
                        'role' => 'user',
                        'content' => json_encode([
                            'pokemonName' => $pokemonName,
                            'pokemonType' => $pokemonType,
                        ])
                    ]
                ]
            ]);
            $missatge = $response['choices'][0]['message']['content'];

            $audio = $this->textToSpeech($missatge);
            /* return response()->json(['missatge' => $missatge, 'audio' => $audio]); */
            //Return the mp3 file
            return response($audio, 200)->header('Content-Type', 'audio/mpeg');
    }

    protected function textToSpeech($text) {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json'
            ])->post($this->apiAudioSpeech, [
                'model' => 'tts-1',
                'voice' => 'nova',
                'input' => $text
            ]);
            
            $audio = $response;
            return $audio; 
    }
}
