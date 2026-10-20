<script setup>

import Home from "@primeicons/vue/home";
import {Breadcrumb} from "primevue";
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
<!--    <Breadcrumb :home="home" :model="items">-->
<!--        <template #item="{ item }">-->
<!--            <Link v-if="item.to" :href="item.to" class="flex items-center gap-2 navigation-link">-->
<!--                <component :is="item.icon" v-if="item.icon" class="w-4 h-4" />-->
<!--                <span v-if="item.label">{{ item.label }}</span>-->
<!--            </Link>-->

<!--            <span v-else class="flex items-center gap-2 current-text">-->
<!--                <component :is="item.icon" v-if="item.icon" class="w-4 h-4" />-->
<!--                <span v-if="item.label">{{ item.label }}</span>-->
<!--            </span>-->
<!--        </template>-->
<!--    </Breadcrumb>-->
    <Link href="/gene-app">Back Home</Link>
    <div>
        {{ gene.data.symbol}}
    </div>

</template>
