@extends('layouts.app', [
    'title' => 'Page introuvable',
    'breadcrumbs' => [['label' => 'Page introuvable', 'url' => null]],
])

@section('content')
<div class="container text-center py-5">
    <h1 class="fw-bold mb-3">Page introuvable</h1>
    <p class="mb-4">La page que vous cherchez n'existe pas ou a été déplacée.</p>
    <a href="{{ route('livres.index') }}" class="btn btn-primary">Retour au catalogue</a>
</div>
@endsection
