@extends('layouts.app', [
    'title' => 'Catégories',
    'breadcrumbs' => [['label' => 'Catégories', 'url' => null]],
])

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4">Catégories</h1>

    <div class="row">
        @forelse($categories as $categorie)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h2 class="h5 mb-0">{{ $categorie->nom }}</h2>
                        <span class="badge bg-primary rounded-pill">
                            {{ $categorie->livres_count }} {{ Str::plural('livre', $categorie->livres_count) }}
                        </span>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Aucune catégorie pour le moment.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
