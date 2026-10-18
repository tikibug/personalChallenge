<!-- resources/js/Pages/Genes/Index.vue -->
<template>
  <div class="p-6">
    <h1 class="text-xl font-bold">{{ pageTitle }}</h1>
      <div>
          <IconField class="w-100">
              <InputText
                  v-model="search"
                  placeholder="Search by symbol, name, or HGNC ID..."
                  size="large"
                  fluid
                  @keydown.enter="doSearch"
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
                     @page="onPage"
                     tableStyle="min-width: 50rem">
              <Column field="hgnc_id" header="HGNC ID"/>
              <Column field="symbol" header="Symbol" />
              <Column field="name" header="Name" />
              <Column field="status" header="Status" />
              <Column field="locus_group" header="Locus Group" />
              <Column field="locus_type" header="Locus Type" />
          </DataTable>
      </div>
  </div>
</template>

<script setup>
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import IconField from 'primevue/iconfield'
    import InputText from 'primevue/inputtext';
    import InputIcon from 'primevue/inputicon';
    import Times from '@primeicons/vue/times';
    import { router } from '@inertiajs/vue3'
    import { ref } from 'vue';

    const props = defineProps({
        pageTitle: String,
        genes: Object,
        filters: Object,
    })

    const search = ref(props.filters?.search ?? '');

    const onPage = (event) => {
        router.get(
            '/genes',
            {
                page: event.page + 1,
                search: search.value,
            },
            {
                preserveState: true,
                replace: true,
            }
        )
    }

    const doSearch = () => {
        router.get('/genes', {
            // page: 1,
            search: search.value,
        }, {
            preserveState: true,
            replace: true,
        })
    }
</script>
