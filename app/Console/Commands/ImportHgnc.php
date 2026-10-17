<?php

namespace App\Console\Commands;

use App\Models\Gene;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

#[Signature('app:import-hgnc')]
#[Description('Command description')]
class ImportHgnc extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        ini_set('memory_limit', '512M');

        $content = file_get_contents(
            database_path('data/protein-coding_gene.json')
        );
        $json = json_decode(
            $content,
            true,
            512,
            JSON_THROW_ON_ERROR,
        );


        foreach ($json['response']['docs'] as $record) {
            Gene::updateOrCreate(
                [
                    'hgnc_id' => $record['hgnc_id']
                ],
                [
                    'symbol' => $record['symbol'],
                    'name' => $record['name'],

                    'status' => $record['status'],
                    'locus_group' => $record['locus_group'] ?? null,
                    'locus_type' => $record['locus_type'] ?? null,
                    'location' => $record['location'] ?? null,
                    'location_sortable' => $record['location_sortable'] ?? null,

                    'ensembl_gene_id' => $record['ensembl_gene_id'] ?? null,
                    'entrez_id' => $record['entrez_id'] ?? null,

                    'alias_symbols' => $record['alias_symbol'] ?? [],
                    'alias_names' => $record['alias_name'] ?? [],
                    'previous_symbols' => $record['prev_symbol'] ?? [],
                    'previous_names' => $record['prev_name'] ?? [],

                    'gene_groups' => collect($record['gene_group'] ?? [])
                        ->map(fn ($group, $i) => [
                            'id' => $record['gene_group_id'][$i] ?? null,
                            'name' => $group,
                        ])
                        ->values(),

                    'external_ids' => [
                        'omim' => $record['omim_id'] ?? [],
                        'uniprot' => $record['uniprot_ids'] ?? [],
                        'refseq' => $record['refseq_accession'] ?? [],
                        'ccds' => $record['ccds_id'] ?? [],
                    ],
                ]
            );
        }
    }
}
