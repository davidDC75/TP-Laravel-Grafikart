<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsInboundAttributes;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Facades\Hash as HashFacade;

class Hash implements CastsInboundAttributes
{
    /**
     * Permet de hasher automatiquement le password lors d'une affectation $user->password='test'
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return HashFacade::make($value);
    }
}
