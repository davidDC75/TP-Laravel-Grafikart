@extends('admin.base')

@section('title', $property->exists ? "Editer un bien" : "Créer un bien")

@section('content')
    <h1>@yield('title')</h1>

    <form class="vstack gap-2" action="{{ route($property->exists ? 'admin.property.update':'admin.property.store', $property)  }}" method="post" enctype="multipart/form-data">
        @csrf
        @method($property->exists ? 'put':'post')

        <div class="row">
            <div class="col" style="flex: 100">

                <div class="row">
                    <x-input class="col" name="title" label="Titre" :value="$property->title"></x-input>
                    <div class="col row">
                        <x-input class="col" name="surface" label="Surface" :value="$property->surface"></x-input>
                        <x-input class="col" name="price" label="Prix" :value="$property->price"></x-input>
                    </div>
                </div>
                <x-input type="textarea" name="description" label="Description" :value="$property->description"></x-input>
                <div class="row">
                    <x-input class="col" name="rooms" label="Pièce" :value="$property->rooms"></x-input>
                    <x-input class="col" name="bedrooms" label="Chambres" :value="$property->bedrooms"></x-input>
                    <x-input class="col" name="floor" label="Étage" :value="$property->floor"></x-input>
                </div>
                <div class="row">
                    <x-input class="col" name="address" label="Adresse" :value="$property->address"></x-input>
                    <x-input class="col" name="postal_code" label="Code postal" :value="$property->postal_code"></x-input>
                    <x-input class="col" name="city" label="Ville" :value="$property->city"></x-input>
                </div>
                @php
                    $tblOptions = $property->options()->pluck('id');
                @endphp
                <x-select label="Options" :value="$tblOptions" name='options' :options="$options" multiple="true"></x-select>
                <x-checkbox label="Vendu" name="sold" :value="$property->sold" :options="$options"></x-checkbox>
                <div>
                    <button class="btn btn-primary mt-2">
                        @if($property->exists)
                            Modifier
                        @else
                            Créer
                        @endif
                    </button>
                </div>
            </div>

            <div class="col vstack gap-3" style="flex: 25">
                @foreach($property->pictures as $picture)
                    <div id="picture{{ $picture->id }}" class="position-relative">
                    <img src="{{ $picture->getImageUrl() }}" alt="" class="w-100 d-block">
                        <button type="button"
                            class="btn btn-danger position-absolute bottom-0 w-100 start-0"
                            hx-delete="{{ route('admin.picture.destroy', $picture) }}"
                            hx-target="#picture{{ $picture->id }}"
                            hx-swap="delete"
                        >
                            <span class="htmx-indicator spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Supprimer
                        </button>
                    </div>
                @endforeach
                <x-upload label="Images" name="pictures" multiple="true"></x-upload>
            </div>
        </div>
    </form>
@endsection
