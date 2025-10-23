<script setup>
import { Head, Link } from "@inertiajs/vue3";
import Header from "@/Components/Header.vue";
import WelcomeSection from "@/Components/WelcomeSection.vue";
import MenuSection from "@/Components/MenuSection.vue";
import { welcome } from "./../constants/constants.json";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <div class="container px-10 py-[1.5rem] max-w-[95%] mx-auto flex flex-col">
        <Head title="Welcome" />
        <Header />
        <WelcomeSection
            :header="welcome.header"
            :text="welcome.text"
            :button-text="welcome.textButton"
        />
        <MenuSection />
        <ReviewSection />
    </div>
</template>

<style></style>
