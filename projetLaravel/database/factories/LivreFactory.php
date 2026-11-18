<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Livre;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Auteur;

/**
 * Fabrique de livres pour les tests : Livre::factory()->create()
 *
 * @extends Factory<Livre>
 */
class LivreFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titre' => rtrim($this->faker->unique()->sentence(3), '.'),
            'annee' => $this->faker->numberBetween(1850, 2025),
            'nb_pages' => $this->faker->numberBetween(80, 900),
            'isbn' => $this->faker->unique()->isbn13(),
            'resume' => $this->faker->paragraph(),
            'disponible' => true,
            'categorie_id' => Categorie::factory(),
            'auteur_id' => Auteur::factory(), // remplace 'auteur' => $this->faker->name(),
        ];
    }

    /** Livre déjà emprunté : Livre::factory()->indisponible()->create() */
    public function indisponible(): static
    {
        return $this->state(['disponible' => false]);
    }
}
