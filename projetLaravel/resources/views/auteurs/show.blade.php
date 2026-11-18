@extends('layouts.app', [
    'title' => $auteur->nom_complet,
    'breadcrumbs' => [
        ['label' => 'Catalogue', 'url' => route('livres.index')],
        ['label' => $auteur->nom_complet, 'url' => null],
    ],
])

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4">{{ $auteur->nom_complet }}</h1>

    <div class="row">
        @forelse ($livres as $livre)
            <div class="col-md-6 col-lg-4 mb-4">
                <x-livre-card :livre="$livre" />
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Aucun livre pour cet auteur.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
