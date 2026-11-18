@extends('layouts.app', [
    'title' => 'Ajouter un livre',
    'breadcrumbs' => [
        ['label' => 'Gestion des livres', 'url' => route('gestion.livres.index')],
        ['label' => 'Ajouter', 'url' => null],
    ],
])

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4">Ajouter un livre</h1>

    <form method="POST" action="{{ route('gestion.livres.store') }}">
        @csrf

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" id="titre" name="titre" value="{{ old('titre') }}"
                   class="form-control @error('titre') is-invalid @enderror">
            @error('titre') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="auteur_id" class="form-label">Auteur</label>
            <select id="auteur_id" name="auteur_id" class="form-select @error('auteur_id') is-invalid @enderror">
                <option value="">— Choisir —</option>
                @foreach ($auteurs as $auteur)
                    <option value="{{ $auteur->id }}" @selected(old('auteur_id') == $auteur->id)>
                        {{ $auteur->nom_complet }}
                    </option>
                @endforeach
            </select>
            @error('auteur_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="categorie_id" class="form-label">Catégorie</label>
            <select id="categorie_id" name="categorie_id" class="form-select @error('categorie_id') is-invalid @enderror">
                <option value="">— Choisir —</option>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}" @selected(old('categorie_id') == $categorie->id)>
                        {{ $categorie->nom }}
                    </option>
                @endforeach
            </select>
            @error('categorie_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="annee" class="form-label">Année</label>
                <input type="text" id="annee" name="annee" value="{{ old('annee') }}"
                       class="form-control @error('annee') is-invalid @enderror">
                @error('annee') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="nb_pages" class="form-label">Nombre de pages</label>
                <input type="text" id="nb_pages" name="nb_pages" value="{{ old('nb_pages') }}"
                       class="form-control @error('nb_pages') is-invalid @enderror">
                @error('nb_pages') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" id="isbn" name="isbn" value="{{ old('isbn') }}"
                       class="form-control @error('isbn') is-invalid @enderror">
                @error('isbn') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="resume" class="form-label">Résumé</label>
            <textarea id="resume" name="resume" rows="4"
                      class="form-control @error('resume') is-invalid @enderror">{{ old('resume') }}</textarea>
            @error('resume') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-check mb-4">
            <input type="checkbox" id="disponible" name="disponible" value="1"
                   class="form-check-input" @checked(old('disponible'))>
            <label for="disponible" class="form-check-label">Disponible</label>
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer</button>
        <a href="{{ route('gestion.livres.index') }}" class="btn btn-outline-secondary">Annuler</a>
    </form>
</div>
@endsection
