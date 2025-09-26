<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />
    <Header />
</template>

<style></style>
