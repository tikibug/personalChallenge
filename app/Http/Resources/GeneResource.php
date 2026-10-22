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

            'aliases' => $this->alias_symbol,

            'previous_symbols' => $this->prev_symbol
                ? explode('|', $this->prev_symbol)
                : [],
        ];
    }
}
