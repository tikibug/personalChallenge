<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gene extends Model
{
    protected $fillable = [
        'hgnc_id',
        'symbol',
        'name',
        'status',
        'locus_group',
        'locus_type',
        'location',
        'location_sortable',
        'date_approved_reserved',
        'date_symbol_changed',
        'date_name_changed',
        'date_modified',
        'ensembl_gene_id',
        'entrez_id',
        'alias_symbol',
        'alias_names',
        'previous_symbols',
        'previous_names',
        'gene_groups',
        'external_ids',
        ];

    protected function casts(): array {
        return [
            'date_approved_reserved' => 'date',
            'date_symbol_changed' => 'date',
            'date_name_changed' => 'date',
            'date_modified' => 'date',

            'alias_symbol' => 'array',
            'alias_names' => 'array',
            'previous_symbols' => 'array',
            'previous_names' => 'array',
            'gene_groups' => 'array',
            'external_ids' => 'array',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'hgnc_id';
    }

    public function scopeKeywordSearch($query, string $term) {
        return $query->where(fn($query) =>
            $query->whereLike('symbol', "%{$term}%")
                ->orWhereLike('name', "%{$term}%")
                ->orWhereLike('hgnc_id', "%{$term}%")
        );

    }
}
