<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. La nouvelle colonne, vide pour l'instant
        Schema::table('livres', function (Blueprint $table) {
            $table->foreignId('auteur_id')->nullable()->after('titre')
                ->constrained('auteurs')->nullOnDelete();
        });

        // 2. Le transfert : un auteur par nom distinct. On utilise DB et non les modèles :
        //    une migration doit encore fonctionner quand les modèles auront changé.
        $noms = DB::table('livres')->whereNotNull('auteur')->distinct()->pluck('auteur');

        foreach ($noms as $nomComplet) {
            $morceaux = preg_split('/\s+/', trim($nomComplet));
            $nom = array_pop($morceaux);               // dernier mot = nom
            $prenom = implode(' ', $morceaux) ?: null; // le reste = prénom

            $auteurId = DB::table('auteurs')->insertGetId([
                'nom' => $nom, 'prenom' => $prenom, 'created_at' => now(), 'updated_at' => now(),
            ]);

            DB::table('livres')->where('auteur', $nomComplet)->update(['auteur_id' => $auteurId]);
        }

        // 3. L'ancienne colonne. Elle fait partie d'un index : on retire l'index d'abord.
        Schema::table('livres', function (Blueprint $table) {
            $table->dropIndex(['titre', 'auteur']);
            $table->index('titre');
            $table->dropColumn('auteur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Recréer l'ancienne colonne (nullable le temps du transfert)
        Schema::table('livres', function (Blueprint $table) {
            $table->string('auteur')->nullable()->after('titre');
        });

        // 2. Recopier "prénom nom" depuis la table auteurs
        $livres = DB::table('livres')
            ->join('auteurs', 'livres.auteur_id', '=', 'auteurs.id')
            ->select('livres.id', 'auteurs.prenom', 'auteurs.nom')
            ->get();

        foreach ($livres as $livre) {
            DB::table('livres')->where('id', $livre->id)->update([
                'auteur' => trim($livre->prenom . ' ' . $livre->nom),
            ]);
        }

        // 3. Remettre l'index d'origine, puis supprimer la clé étrangère et la colonne
        Schema::table('livres', function (Blueprint $table) {
            $table->dropIndex(['titre']);
            $table->index(['titre', 'auteur']);
            $table->dropConstrainedForeignId('auteur_id');
        });
    }
};
