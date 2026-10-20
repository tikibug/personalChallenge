<!-- resources/js/Pages/Genes/Index.vue -->
<script setup>
import Times from '@primeicons/vue/times';
import Home from '@primeicons/vue/home';
import {
    Breadcrumb,
    DataTable,
    Column,
    IconField,
    InputText,
    InputIcon
} from 'primevue';
import { router, Link } from '@inertiajs/vue3'
import { ref, watch } from 'vue';

const props = defineProps({
    pageTitle: String,
    genes: Object,
    filters: Object,
})

const page = ref(props.genes?.current_page ?? 1);
const search = ref(props.filters?.search ?? '');
const sort = ref(props.filters?.sort ?? 'symbol');
const direction = ref(props.filters?.direction ?? 'asc');


const queryParams = () => ({
    page: page.value,
    search: search.value,
    sort: sort.value,
    direction: direction.value,
});

const home = {
    icon: Home,
    to: '/gene-app'
};

const items = [
    { label: 'Genes' }
];

let debounceTimer = null;

watch(search, (value) => {
    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(() => {
        doSearch();
    }, 300)
})

const onPage = (event) => {
    page.value = event.page + 1;
    router.get(
        '/genes', queryParams(), {
            preserveState: true,
            replace: true,
        }
    )
}

const onSort = (event) => {
    sort.value = event.sortField;
    direction.value = event.sortOrder === 1 ? 'asc' : 'desc';
    router.get(
        '/genes', queryParams(), {
            preserveState: true,
            replace: true,
        }
    );
}

const goToGene = (event) => {
    router.get(`/genes/${encodeURIComponent(event.data.hgnc_id)}`, queryParams());
}

const doSearch = () => {
    if (search.value.length === 0 || search.value.length > 1) {
        router.get('/genes', queryParams())
    }
}
</script>

<template>
    <Breadcrumb :home="home" :model="items">
        <template #item="{ item }">
            <Link v-if="item.to" :href="item.to" class="flex items-center gap-2 navigation-link">
                <component :is="item.icon" v-if="item.icon" class="w-4 h-4" />
                <span v-if="item.label">{{ item.label }}</span>
            </Link>

            <span v-else class="flex items-center gap-2 current-text">
                <component :is="item.icon" v-if="item.icon" class="w-4 h-4" />
                <span v-if="item.label">{{ item.label }}</span>
            </span>
        </template>
    </Breadcrumb>
  <div class="p-6">
    <h1 class="text-xl font-bold">{{ pageTitle }}</h1>
      <div>
          <IconField class="w-100">
              <InputText
                  v-model="search"
                  placeholder="Search by symbol, name, or HGNC ID..."
                  size="large"
                  fluid
              />
              <InputIcon
                  v-if="search"
                  class="cursor-pointer"
                  @click="search = ''">
                  <Times />
              </InputIcon>
        </IconField>
      </div>

      <div class="w-full">
          <DataTable :value="genes.data"
                     paginator
                     lazy
                     :rows="genes.per_page"
                     :totalRecords="genes.total"
                     :first="(genes.current_page - 1) * genes.per_page"
                     :sortField="sort"
                     :sortOrder="direction === 'desc' ? -1 : 1"
                     :row-hover="true"
                     @page="onPage"
                     @sort="onSort"
                     @row-click="goToGene"
                     tableStyle="min-width: 50rem">
              <Column field="hgnc_id" header="HGNC ID" sortable/>
              <Column field="symbol" header="Symbol" sortable/>
              <Column field="name" header="Name" sortable/>
              <Column field="status" header="Status" sortable/>
              <Column field="locus_group" header="Locus Group" sortable/>
              <Column field="locus_type" header="Locus Type" sortable/>
          </DataTable>
      </div>
  </div>
</template>

