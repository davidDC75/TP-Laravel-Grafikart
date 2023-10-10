@extends('base')

@section('title','Authentification')

@section('content')

    <div class="mt-4 container">
        <h1>@yield('title')</h1>

        @include('shared.flash')

        <form method="post" action)="{{ route('login') }}" class="vstack gap-3">
            @csrf
            @include('shared.input',['class'=> 'col','name'=>'email','label'=>'Email'])
            @include('shared.input',['type'=>'password','class'=> 'col','name'=>'password','label'=>'Mot de passe'])

            <div>
                <button class="btn btn-primary mt-3">Se Connecter</button>
            </div>
        </form>
    </div>
@endsection
