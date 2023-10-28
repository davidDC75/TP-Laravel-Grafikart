<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# TP Laravel 10 de Grafikart

## Créer la migration en même temps que le model

-m = Création d'une fichier de migration en même temps que le model.

```
php artisan make:model -m Option
```

## Tom Select

Librairie Javascript qui permet de modifier les éléments html 'select' plus facilement

[Home de Tom Select](https://tom-select.js.org)

## htmx

Librairie JS qui permet de faire des requêtes AJAX et modifier dynamiquement le site en utilisant uniquement que des attributs html.

[htmx](https://htmx.org/docs/)

## Glide

Librairie php de manipulation d'image

[Glide PHP](https://glide.thephpleague.com/)

## Spatie -  laravel-medialibrary

[Spatie](https://spatie.be/open-source)

## Local et global scopes

[Doc Laravel](https://laravel.com/docs/10.x/eloquent#query-scopes)

## Soft Deleting (Eloquent)

[Doc Laravel](https://laravel.com/docs/10.x/eloquent#soft-deleting)

## Eloquent: Mutators & Casting

[Doc Laravel](https://laravel.com/docs/10.x/eloquent-mutators)

## Pour faire un custom cast

[Doc Laravel](https://laravel.com/docs/10.x/eloquent-mutators#custom-casts)

Pour avoir le get et le set :

```
php artisan make:cast Hash
```

Pour avoir seulement le set (cas password) :

```
php artisan make:cast Hash --inbound
```

## Using Model Factories

[Doc Laravel](https://laravel.com/docs/10.x/seeding#using-model-factories)

 Supprime les tables, refait les migrations et termine par le seeding

```
php artisan migrate:fresh --seed
```

## Vite

Lancer le serveur de développement :

```
npm run dev
```

[Doc Laravel](https://laravel.com/docs/10.x/vite)

## Les composants (view et Component)

Générer deux fichiers : app/View/Components/Name.php et resources/views/components/name.blade.php

```
php artisan make:component Recent
```

Générer que la vue blade :

```
php artisan make:component Input --view
```

Accés dans blade :

```
<x-recent></x-recent>
```

## Laravel Breeze

(Doc Laravel)[https://laravel.com/docs/10.x/starter-kits]

```
composer require laravel/breeze --dev
```

### /!\ Modification package vendor

Quand on génère l'installation de breeze, il y a une erreur de compilation. Cela concerne le fichier postcss.config.js .
Le fichier est regénéré automatiquement et se trouve dans le dossier vendor/laravel/breeze/stubs/postcss.config.js

il faut remplacer son contenu par :

```
module.exports = {
    plugins: {
        tailwindcss: {},
        autoprefixer: {},
    },
};
```

Idéalement, il faut l'installer au tout début du projet avant de coder quoi que ce soit. Comme ça, on est tranquille.


```
php artisan breeze:install blade
```

## Authorization

[Doc Laravel](https://laravel.com/docs/10.x/authorization)

Créer une policy

```
php artisan make:policy PropertyPolicy --model=Property
```

## Laravel Service Provider

[Doc Laravel](https://laravel.com/docs/10.x/providers)

## Laravel Facades

[Doc Laravel](https://laravel.com/docs/10.x/facades)

## Events

[Doc Laravel](https://laravel.com/docs/10.x/events)

Créer un événement

```
php artisan make:event ContactRequestEvent
```

Créer un listener

```
php artisan make:listener ContactListener --event=ContactRequestEvent
```

Déclencher l'événement :

```
event(new ContactRequestEvent($property, $request->validated()));
```

Ajouter dans app/Providers/EventServiceProvider.php à la propriété $listen

```
        ContactRequestEvent::class => [
            ContactListener::class
        ]
```

## Notifications

[Doc Laravel](https://laravel.com/docs/10.x/notifications)

Créer une notification

```
php artisan make:notification ContactRequestNotification
```

Créer la migration nécessaire pour utiliser le canal database

```
php artisan notifications:table
```

# Actuellement vidéo 29




