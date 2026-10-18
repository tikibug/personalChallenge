<?php

namespace App\Http\Controllers;

use App\Models\Gene;
use Inertia\Inertia;

class GeneListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genes = Gene::take(10)->get();
        $pageTitle = "Genes";

        // 2. Pass variables by their names as strings
//        return view('genes.index', compact('genes', 'pageTitle'));
        return Inertia::render('Genes/Index', [
            'genes' => $genes,
        ]);
    }

}
