<script setup>
import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";
</script>

<template>
    <div class="container px-10 py-[1.5rem] max-w-[95%] mx-auto flex flex-col">
        <Header />
        <router-view />
        <Footer />
    </div>
</template>
