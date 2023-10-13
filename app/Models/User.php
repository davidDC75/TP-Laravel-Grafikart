<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use App\Casts\Hash as HashCast;

/**
 * Pour activer la vérification des emails on implément l'interface MustVerifyEmail
 * @mixin IdeHelperUser
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        /*
         * Le HashCast ne fonctionne pas avec breeze
         * on utilise 'hashed' à la place
         */
        //'password' => HashCast::class
        'password' => 'hashed'
    ];

    /*
     * Cette méthode protégé permet de crée un attribut
     * pour cette exemple, on défini un getter et un setter
     * pour la propriété password
     * le get c'est le traitement à faire lorsqu'on récupére une valeur de la base de donnée
     * le set c'est le traitement à faire lorsqu'on écrit une valeur en base de donnée
     * par exemple, ici le password est automatiquement hashé
     * $user->password= appellera le set
     */
    /*
    protected function password(): Attribute {
        return Attribute::make(
            get: fn (?string $value) => $value,
            set: fn (string $value) => Hash::make($value)
        );
    }
    */
}
