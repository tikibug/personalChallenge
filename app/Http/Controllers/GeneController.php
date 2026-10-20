<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeneResource;
use App\Models\Gene;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GeneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->string('search')
            ->trim()
            ->lower();

        $allowedSorts = [
            'hgnc_id',
            'symbol',
            'name',
            'status',
            'locus_group',
            'locus_type',
        ];

        $sort = in_array($request->sort, $allowedSorts)
            ? $request->sort
            : 'symbol';

        $direction = $request->direction === 'desc'
            ? 'desc'
            : 'asc';

        $genes = Gene::query()
            ->when($search,
                fn ($query) =>
                    $query->keywordSearch($search)
            )
            ->when($sort === 'hgnc_id',
                fn ($query) =>
                    $query->orderByRaw("CAST(REGEXP_REPLACE(\"{$sort}\", '\D', '', 'g') AS INTEGER) {$direction}"),
                fn ($query) =>
                    $query->orderBy($sort, $direction)
            )
            ->paginate(25)
            ->withQueryString();

        $pageTitle = "Genes Search";

        return Inertia::render('Genes/Index', [
            'pageTitle' => $pageTitle,
            'genes' => $genes,
            'filters' => [
                'search' => $search,
                'sort' => $sort,
                'direction' => $direction,
            ],
        ]);
    }

    public function show(Gene $gene) {
        return Inertia::render('Genes/Show', [
            'gene' => new GeneResource($gene),
        ]);
    }

    public function autocomplete(Request $request) {
        $search = $request->string('search')->trim();

        if (strlen($search) < 2) {
            return response()->json([]);
        }

        return Gene::query()
            ->keywordSearch($search)
            ->orderByRaw(
                'case
                when symbol = ? then 1
                when symbol like ? then 2
                else 3
             end',
                [
                    strtoupper($search),
                    strtoupper($search) . '%',
                ]
            )
            ->limit(10)
            ->get(['hgnc_id', 'symbol', 'name']);
    }

}
