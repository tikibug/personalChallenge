<!-- resources/js/Pages/Genes/Index.vue -->
<template>
  <div class="p-6">
    <h1 class="text-xl font-bold">Genes List</h1>
      <div class="w-full">
          <DataTable :value="genes" tableStyle="min-width: 50rem">
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

defineProps({
  genes: Array
})
</script>
