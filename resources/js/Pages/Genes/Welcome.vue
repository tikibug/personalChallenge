<script setup>
import { ref } from 'vue';
import AutoComplete from 'primevue/autocomplete';
import { router } from '@inertiajs/vue3'

const suggestions = ref([])
const locusType = ref('')
const page = ref(1);
const search = ref(null);
const sort = ref('symbol');
const direction = ref('asc');

const queryParams = () => ({
    page: page.value,
    search: search.value,
    locusType: locusType.value,
    sort: sort.value,
    direction: direction.value,
});

const searchGenes = async (event) => {
    const response = await fetch(
        `/genes/autocomplete?search=${encodeURIComponent(event.query)}`
    )

    suggestions.value = await response.json()
}

const selectGene = (event) => {
    router.get(`/genes/${encodeURIComponent(event.value.hgnc_id)}`, {},
    {
        preserveState: false,
        replace: false,
    })
}

const doSearch = (event) => {
    router.get(`/genes/`, queryParams(),
        {
            preserveState: false,
            replace: false,
        })
}

</script>
<template>
    <!-- Hero Section Container -->
    <div class="relative overflow-hidden bg-surface-900 text-surface-0 rounded-2xl my-6 p-8 sm:p-12 md:p-24 flex flex-col items-center justify-center text-center">


        <!-- Hero Content -->
        <div class="relative z-10 max-w-3xl mx-auto flex flex-col items-center gap-6">

            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight leading-tight">
                Genes <span class="text-9xl">R</span> Us
            </h1>

            <p class="text-lg sm:text-xl text-surface-400 max-w-xl mx-auto leading-relaxed">
                Search through an incomplete, but still a bunch, of <span class="font-bold">genes</span> tailored just for you by someone other than me.
            </p>

            <!-- Integrated Search Bar -->
            <div class="w-full max-w-2xl mt-4 bg-surface-800/80 backdrop-blur border border-surface-700 p-2 rounded-2xl shadow-2xl flex-col sm:flex-row items-center gap-2">

                <AutoComplete
                    v-model="search"
                    :suggestions="suggestions"
                    optionLabel="symbol"
                    @complete="searchGenes"
                    @option-select="selectGene"
                    @keyup.enter="doSearch"
                    fluid
                    placeholder="Search by symbol, HNGC Id, or keyword..."
                />
            </div>
        </div>
    </div>
</template>

