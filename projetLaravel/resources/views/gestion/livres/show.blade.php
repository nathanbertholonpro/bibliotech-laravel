@extends('layouts.app', [
    'title' => $livre->titre,
    'breadcrumbs' => [
        ['label' => 'Gestion des livres', 'url' => route('gestion.livres.index')],
        ['label' => $livre->titre, 'url' => null],
    ],
])

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">{{ $livre->titre }}</h1>
            @if ($livre->disponible)
                <span class="badge bg-success fs-6">Disponible</span>
            @else
                <span class="badge bg-warning text-dark fs-6">Emprunté</span>
            @endif
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Auteur</dt>
                <dd class="col-sm-9">{{ $livre->auteur?->nom_complet }}</dd>

                <dt class="col-sm-3">Catégorie</dt>
                <dd class="col-sm-9">{{ $livre->categorie->nom ?? 'Non classé' }}</dd>

                <dt class="col-sm-3">Année</dt>
                <dd class="col-sm-9">{{ $livre->annee }}</dd>

                <dt class="col-sm-3">Pages</dt>
                <dd class="col-sm-9">{{ $livre->nb_pages }}</dd>

                <dt class="col-sm-3">ISBN</dt>
                <dd class="col-sm-9"><code>{{ $livre->isbn }}</code></dd>
            </dl>

            <h2 class="h5">Résumé</h2>
            <p>{{ $livre->resume }}</p>
        </div>
    </div>

    <a href="{{ route('gestion.livres.index') }}" class="btn btn-outline-secondary mt-3">
        Retour à la liste
    </a>
</div>
@endsection
