<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\View\View;

class CategorieController extends Controller
{
    /**
     * Liste des catégories actives, avec le nombre de livres de chacune.
     */
    public function index(): View
    {
        $categories = Categorie::actives()
            ->withCount('livres')
            ->orderBy('nom')
            ->get();

        return view('categories.index', ['categories' => $categories]);
    }
}
