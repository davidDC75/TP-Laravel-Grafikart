<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\UploadedFile;

/**
 * @mixin IdeHelperProperty
 */
class Property extends Model
{
    use HasFactory;
    /*
     * Pour gérer le soft deleting
     * Il faut ajouter une colonne : deleted_at à la table
     * https://laravel.com/docs/10.x/eloquent#soft-deleting
     */
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'surface',
        'rooms',
        'bedrooms',
        'floor',
        'price',
        'city',
        'address',
        'postal_code',
        'sold'
    ];

    /*
     * Castring
     * https://laravel.com/docs/10.x/eloquent-mutators
     */
    protected $casts = [
        'created_at' => 'string',
        'sold' => 'boolean'
    ];

    public function options(): BelongsToMany {
        return $this->belongsToMany(Option::class);
    }

    public function getSlug(): string {
        return \Str::slug($this->title);
    }

    public function pictures():HasMany {
        return $this->hasMany(Picture::class);
    }

    /**
     * @param UploadedFile[] $files
     */
    public function attachFiles(array $files) {
        // Ce tableau contiendra les filename valides
        $pictures = [];
        foreach ($files as $file) {
            // Si error alors on exécute pas la suite
            if ($file->getError()) {
                continue;
            }
            // Met le fichier dans le dossier properties du disk 'public'
            $filename = $file->store('properties/'.$this->id, 'public');
            $pictures[] = [
                'filename' => $filename
            ];
        }
        if (count($pictures) > 0) {
            // On crée toutes les pictures en une seule fois
            $this->pictures()->createMany($pictures);
        }
    }

    public function getPicture(): ?Picture {
        return $this->pictures[0] ?? null;
    }

    public function isSoftDeleted(): ?bool {
        return !($this->deleted_at === null);
    }

    /*
     * Ce scope permet de récupérer les bien disponible ou pas
     * utilisé dans le controller avec available()
     * $properties=Property::with('pictures')->available(true)->recent()->limit(4)->get();
     */
    public function scopeAvailable(Builder $builder, bool $available = true): Builder {
        return $builder->where('sold', !$available);
    }

    // Ce scope permet de récupérer les bien les plus récents
    public function scopeRecent(Builder $builder): Builder {
        return $builder->orderBy('created_at','desc');
    }
}
