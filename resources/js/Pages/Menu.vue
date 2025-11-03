<script setup>
import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <container class="px-10 py-[1.5rem] max-w-[95%] mx-auto flex flex-col">
        <Header />
        <Footer />
    </container>
</template>

<style></style>
