<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('genes', function (Blueprint $table) {
            $table->id();

            $table->string('hgnc_id')->unique();
            $table->string('symbol')->index();
            $table->string('name');

            $table->string('status');

            $table->string('locus_group')->nullable();
            $table->string('locus_type')->nullable();

            $table->string('location')->nullable();;
            $table->string('location_sortable')->nullable();

            $table->date('date_approved_reserved')->nullable();
            $table->date('date_symbol_changed')->nullable();
            $table->date('date_name_changed')->nullable();
            $table->date('date_modified')->nullable();

            $table->string('ensembl_gene_id')->nullable();
            $table->integer('entrez_id')->nullable();

            $table->json('aliase_symbols')->nullable();
            $table->json('alias_names')->nullable();
            $table->json('previous_symbols')->nullable();
            $table->json('previous_names')->nullable();
            $table->json('gene_groups')->nullable();

            $table->json('external_ids')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genes');
    }
};
