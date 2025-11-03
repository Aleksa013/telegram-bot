<script setup>
import Header from "@/Layouts/Header.vue";
import Footer from "@/Layouts/Footer.vue";
import { RouterView } from "vue-router";
</script>

<template>
    <div class="container px-10 py-[1.5rem] max-w-[95%] mx-auto flex flex-col">
        <Header />
        <RouterView />
        <Footer />
    </div>
</template>
