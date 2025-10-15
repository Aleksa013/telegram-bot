<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <container class="px-10 py-[1.5rem] max-w-[95%] mx-auto flex flex-col">
        <h2>Menu</h2>
    </container>
</template>

<style></style>
