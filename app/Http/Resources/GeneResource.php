<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GeneResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'symbol' => $this->symbol,
            'name' => $this->name,
            'hgnc_id' => $this->hgnc_id,
            'status' => $this->status,
            'locus_group' => $this->locus_group,
            'locus_type' => $this->locus_type,
            'location' => $this->location,
            'entrez_id' => $this->entrez_id,
            
            'chromosome' => preg_split('/[pq]/i', $this->location)[0],
            'ensembl_id' => $this->ensembl_gene_id,
            'aliases' => $this->alias_symbol,
            'previous_symbols' => $this->previous_symbols,

            'uniprot_id' => data_get($this, 'external_ids.uniprot')[0],
            'omim_id' => data_get($this, 'external_ids.omim'),
            'refseq_id' => data_get($this, 'external_ids.refseq'),
            'ccds_id' => data_get($this, 'external_ids.ccds'),
        ];
    }
}
