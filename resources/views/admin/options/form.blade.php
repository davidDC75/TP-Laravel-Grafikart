@extends('admin.base')

@section('title', $option->exists ? "Editer une option" : "Créer une option")

@section('content')
    <h1>@yield('title')</h1>

    <form  class="vstack gap-2" action="{{ route($option->exists ? 'admin.option.update':'admin.option.store', $option)  }}" method="post">
        @csrf
        @method($option->exists ? 'put':'post')

        <x-input name="name" label="Nom" :value="$option->name"></x-input>
        <div>
            <button class="btn btn-primary mt-2">
                @if($option->exists)
                    Modifier
                @else
                    Créer
                @endif
            </button>
        </div>
    </form>
@endsection
