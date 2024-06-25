@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('MyTooDooList') }}</div>

                <div class="card-body">
                    <p>Bienvenue, veuillez vous connecter pour accéder à MyTooDooList.</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Form fields here -->

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Me Connecter') }}
                                </button>

                                <a href="{{ route('register') }}" class="btn btn-link">
                                    Vous n'êtes pas inscrit ? Inscrivez-vous ici
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Intégration du fichier CSS -->
<link href="{{ mix('css/app.css') }}" rel="stylesheet">

@endsection

