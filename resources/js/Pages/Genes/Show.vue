<script setup>

import Home from '@primeicons/vue/home';
import {Card, Chip} from "primevue";
import {Link} from "@inertiajs/vue3";

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
    <main class="mx-auto max-w-7xl p-6">

        <!-- Page Header -->
        <header class="mb-8 border-b pb-4">
            <div class="flex flex-wrap items-center gap-3">
                <h1 class="text-4xl font-bold">
                    {{ gene.data.symbol }}
                </h1>

                <Tag
                    :value="gene.data.locus_type"
                    severity="info"
                />
            </div>

            <p class="mt-2 text-lg text-surface-600">
                {{ gene.data.name }}
            </p>

            <p class="mt-1 text-sm text-surface-500">
                {{ gene.data.hgnc_id }}
            </p>
        </header>

        <!-- Primary Content -->
        <section
            aria-label="Gene Overview"
            class="mb-8 grid gap-6 lg:grid-cols-2"
        >

            <article>
                <Card>
                    <template #title>
                        Summary
                    </template>

                    <template #content>
                        <dl class="grid grid-cols-2 gap-y-3">
                            <dt class="font-medium">Symbol</dt>
                            <dd>{{ gene.data.symbol }}</dd>

                            <dt class="font-medium">Name</dt>
                            <dd>{{ gene.data.name }}</dd>

                            <dt class="font-medium">Status</dt>
                            <dd>{{ gene.data.status }}</dd>

                            <dt class="font-medium">Location</dt>
                            <dd>{{ gene.data.location }}</dd>
                        </dl>
                    </template>
                </Card>
            </article>

            <article>
                <Card>
                    <template #title>
                        Genomic Information
                    </template>

                    <template #content>
                        <dl class="grid grid-cols-2 gap-y-3">
                            <dt class="font-medium">Chromosome</dt>
                            <dd>{{ gene.data.chromosome }}</dd>

                            <dt class="font-medium">Locus Group</dt>
                            <dd>{{ gene.data.locus_group }}</dd>

                            <dt class="font-medium">Locus Type</dt>
                            <dd>{{ gene.data.locus_type }}</dd>

                            <dt class="font-medium">HGNC ID</dt>
                            <dd>{{ gene.data.hgnc_id }}</dd>
                        </dl>
                    </template>
                </Card>
            </article>

        </section>

        <!-- Aliases -->
        <section
            aria-labelledby="aliases"
            class="mb-8"
        >
            <Card>
                <template #title>
                    <h2 id="aliases">
                        Aliases
                    </h2>
                </template>

                <template #content>
                    <div class="flex flex-wrap gap-2">
                        <Chip
                            v-for="alias in gene.data.aliases"
                            :key="alias"
                            :label="alias"
                        />
                    </div>
                </template>
            </Card>
        </section>

        <!-- External Links -->
        <section
            aria-labelledby="resources"
            class="mb-8"
        >
            <Card>
                <template #title>
                    <h2 id="resources">
                        External Resources
                    </h2>
                </template>

                <template #content>
                    <nav class="flex flex-wrap gap-3">
                        <Button
                            label="NCBI"
                            as="a"
                            target="_blank"
                            :href="gene.data.ncbi_url"
                        />

                        <Button
                            label="Ensembl"
                            as="a"
                            target="_blank"
                            :href="gene.data.ensembl_url"
                        />

                        <Button
                            label="UniProt"
                            as="a"
                            target="_blank"
                            :href="gene.data.uniprot_url"
                        />
                    </nav>
                </template>
            </Card>
        </section>

        <!-- Footer Actions -->
        <footer class="flex gap-3 border-t pt-4">
            <Button
                label="Back to Search"
                icon="pi pi-arrow-left"
                outlined
            />

            <Button
                label="Copy HGNC ID"
                icon="pi pi-copy"
            />
        </footer>

    </main>
</template>

