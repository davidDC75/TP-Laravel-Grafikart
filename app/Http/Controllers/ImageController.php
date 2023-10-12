<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;
use League\Glide\Signatures\SignatureFactory;

class ImageController extends Controller
{
    public function show(Request $request,string $path): mixed {
        /*
         * Pour la sécurité de glide afin d'éviter qu'un utilisateur
         * S'amuse à générer de grandes quantités d'images dans le cache
         */
        SignatureFactory::create(config('glide.key'))->validateRequest($request->path(), $request->all());

        // Configuration de glide
        $server = ServerFactory::create([
           // Pour générer la réponse
           'response' => new LaravelResponseFactory($request),
           // Le driver source
           'source' => Storage::disk('public')->getDriver(),
           // Le driver cache
           // Le cache en local pour qu'il ne soit pas accessible
           'cache' => Storage::disk('local')->getDriver(),
           // Le préfixe du dossier du cachd
           'cache_path_prefix' => '.cache',
           // base url de la route
           'base_url' => 'images'
        ]);
        // Retourne l'image
        return $server->getImageResponse($path, $request->all());
    }
}
