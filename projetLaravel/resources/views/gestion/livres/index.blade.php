@extends('layouts.app', [
    'title' => 'Gestion des livres',
    'breadcrumbs' => [['label' => 'Gestion des livres', 'url' => null]],
])

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold mb-0">Gestion des livres</h1>
        <a href="{{ route('gestion.livres.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un livre
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Catégorie</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($livres as $livre)
                    <tr>
                        <td>
                            <a href="{{ route('gestion.livres.show', $livre) }}">{{ $livre->titre }}</a>
                        </td>
                        <td>{{ $livre->auteur?->nom_complet }}</td>
                        <td>{{ $livre->categorie->nom ?? 'Non classé' }}</td>
                        <td>
                            @if ($livre->disponible)
                                <span class="badge bg-success">Disponible</span>
                            @else
                                <span class="badge bg-warning text-dark">Emprunté</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Aucun livre.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $livres->links() }}
</div>
@endsection
