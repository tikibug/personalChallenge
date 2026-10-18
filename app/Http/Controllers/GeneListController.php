<?php

namespace App\Http\Controllers;

use App\Models\Gene;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GeneListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->string('search');
        $genes = Gene::query()
            ->when($search,
                fn ($query) =>
                    $query->where('symbol', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('hgnc_id', 'like', "%{$search}%")
            )
            ->orderBy('symbol')
            ->paginate(25)
            ->withQueryString();
        $pageTitle = "Genes";

        return Inertia::render('Genes/Index', [
            'pageTitle' => $pageTitle,
            'genes' => $genes,
            'filters' => [
                'search' => $search,
            ],
        ]);
    }

}
