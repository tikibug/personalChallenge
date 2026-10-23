<script setup>

import Home from '@primeicons/vue/home';
import {Card, Chip, Panel} from "primevue";
import {Link} from "@inertiajs/vue3";
import { Link as LinkIcon, Tags, MapMarker } from '@primeicons/vue'


const props = defineProps({
    gene: Object,
})

const home = {
    icon: Home,
    to: '/gene-app'
};

const items = [
    { label: 'Genes', to: '/genes' },
    { label: props.gene.symbol }
];
</script>

<template>
     <Link href="/gene-app">Go to Home</Link>
    <main class="mx-auto max-w-7xl p-6">

        <!-- Page Header -->
            <Panel :pt="{ header: { class: 'hidden' } }" class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <div class="flex items-center gap-3">
                            <h1 class="text-4xl font-extrabold tracking-tight text-slate-900">{{ gene.data.symbol }}</h1>
                                <span
                                    v-if="gene.data?.status === 'Approved'" 
                                    class="inline-flex items-center rounded-md bg-emerald-50 px-2.5 py-0.5 text-xs font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-600/20"
                                    >Approved Symbol
                                </span>
                        </div>
                        <p class="mt-2 text-lg text-slate-500 font-medium">{{ gene.data.name }}</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="rounded-xl bg-slate-100 px-4 py-2.5 text-center">
                            <span class="block text-xs font-medium uppercase tracking-wider text-slate-400">HGNC ID</span>
                            <span class="text-sm font-bold font-mono text-slate-700">{{ gene.data.hgnc_id }}</span>
                        </div>
                        <div class="rounded-xl bg-indigo-50 px-4 py-2.5 text-center border border-indigo-100">
                            <span class="block text-xs font-medium uppercase tracking-wider text-indigo-500">Locus Type</span>
                            <span class="text-sm font-bold text-indigo-700">{{ gene.data.locus_type }}</span>
                        </div>
                    </div>
                </div>
            </Panel>

      <!-- Main Grid Content -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
      
      <!-- Left Column: Key Metadata & Nomenclature -->
      <div class="space-y-6 lg:col-span-2">
        
        <!-- Nomenclature & Synonyms Card -->
        <Panel class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
         <template #header>
             <h2 class="text-xl font-bold text-slate-900 flex items-center gap-2">
            <Tags /> Nomenclature & Synonyms
          </h2>
         </template>
          <dl class="divide-y divide-slate-100 text-sm">
            <div class="grid grid-cols-3 gap-4 py-3">
              <dt class="font-semibold text-slate-500">Approved Name</dt>
              <dd class="col-span-2 font-medium text-slate-900">{{ gene.data.name }}</dd>
            </div>
            <div class="grid grid-cols-3 gap-4 py-3">
              <dt class="font-semibold text-slate-500">Previous Symbols</dt>
              <dd class="col-span-2 font-mono text-slate-600">
                <Chip
                    class="rounded bg-slate-100 px-2 py-0.5 text-xs text-slate-700 font-mono"
                    v-for="symb in gene.data.previous_symbols"
                    :key="symb"
                    :label="symb"
                /> 
              </dd>
            </div>
            <div class="grid grid-cols-3 gap-4 py-3">
              <dt class="font-semibold text-slate-500">Aliases</dt>
              <dd class="col-span-2 flex flex-wrap gap-1.5">
                <Chip
                    class="rounded bg-slate-100 px-2 py-0.5 text-xs text-slate-700 font-mono"
                    v-for="alias in gene.data.aliases"
                    :key="alias"
                    :label="alias"
                />
              </dd>
            </div>
            <div class="grid grid-cols-3 gap-4 py-3">
              <dt class="font-semibold text-slate-500">Status</dt>
              <dd class="col-span-2"><span class="text-emerald-600 font-medium">{{ gene.data.status }}</span></dd>
            </div>
          </dl>
        </Panel>

        <!-- Genomic Location Card -->
        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
          <h2 class="mb-4 text-xl font-bold text-slate-900 flex items-center gap-2">
            <MapMarker /> Genomic Location
          </h2>
          <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div class="rounded-xl border border-slate-100 bg-slate-50/50 p-4">
              <span class="block text-xs font-semibold text-slate-400 uppercase">Chromosome</span>
              <span class="mt-1 block text-2xl font-bold text-slate-800">{{ gene.data.chromosome }}</span>
            </div>
            <div class="rounded-xl border border-slate-100 bg-slate-50/50 p-4">
              <span class="block text-xs font-semibold text-slate-400 uppercase">Cytogenetic Band</span>
              <span class="mt-1 block text-2xl font-bold text-slate-800">{{ gene.data.location }}</span>
            </div>
          </div>
        </section>
      </div>

      <!-- Right Column: Cross References (Database Links) -->
      <div class="space-y-6">
        <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
          <h2 class="mb-4 text-xl font-bold text-slate-900 flex items-center gap-2">
           <LinkIcon />  External Cross-References
          </h2>
          <p class="mb-4 text-xs text-slate-400">Authoritative mapped resource linkages curated by HGNC.</p>
          
          <div class="space-y-3">
            <!-- NCBI Gene Link -->
            <a :href="`https://www.ncbi.nlm.nih.gov/gene/?term=${gene.data.entrez_id}`" target="_blank" class="group flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50 p-3.5 transition hover:border-indigo-100 hover:bg-indigo-50/30">
              <div class="flex items-center gap-3">
                <div class="rounded-md bg-blue-100 p-2 text-xs font-bold text-blue-700 group-hover:bg-blue-200">NCBI</div>
                <div>
                  <span class="block text-sm font-bold text-slate-800">NCBI Gene</span>
                  <span class="text-xs font-mono text-slate-400">ID: {{ gene.data.entrez_id }}</span>
                </div>
              </div>
              <span class="text-slate-400 transition group-hover:translate-x-1 group-hover:text-indigo-600">→</span>
            </a>

            <!-- Ensembl Link -->
            <a :href="`https://www.ensembl.org/id/${gene.data.ensembl_id}`" target="_blank" class="group flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50 p-3.5 transition hover:border-indigo-100 hover:bg-indigo-50/30">
              <div class="flex items-center gap-3">
                <div class="rounded-md bg-purple-100 p-2 text-xs font-bold text-purple-700 group-hover:bg-purple-200">ENS</div>
                <div>
                  <span class="block text-sm font-bold text-slate-800">Ensembl Gene</span>
                  <span class="text-xs font-mono text-slate-400">{{ gene.data.ensembl_id }}</span>
                </div>
              </div>
              <span class="text-slate-400 transition group-hover:translate-x-1 group-hover:text-indigo-600">→</span>
            </a>

            <!-- UniProt Link -->
            <a :href="`https://www.uniprot.org/uniprotkb/${gene.data.uniprot_id}`" target="_blank" class="group flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50 p-3.5 transition hover:border-indigo-100 hover:bg-indigo-50/30">
              <div class="flex items-center gap-3">
                <div class="rounded-md bg-cyan-100 p-2 text-xs font-bold text-cyan-700 group-hover:bg-cyan-200">UNI</div>
                <div>
                  <span class="block text-sm font-bold text-slate-800">UniProtKB Protein</span>
                  <span class="text-xs font-mono text-slate-400">{{ gene.data.uniprot_id }}</span>
                </div>
              </div>
              <span class="text-slate-400 transition group-hover:translate-x-1 group-hover:text-indigo-600">→</span>
            </a>
          </div>
        </section>
      </div>
</div>
    </main>
</template>

