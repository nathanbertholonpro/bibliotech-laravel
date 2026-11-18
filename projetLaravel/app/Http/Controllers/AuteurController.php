<?php

namespace App\Http\Controllers;

use App\Models\Auteur;

class AuteurController extends Controller
{
    public function show(Auteur $auteur)
    {
        $livres = $auteur->livres()->with(['categorie', 'auteur'])->get();

        return view('auteurs.show', compact('auteur', 'livres'));
    }
}
