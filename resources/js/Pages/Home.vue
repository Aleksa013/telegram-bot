<script setup>
// import Header from "./../Header.vue";
import Header from "@/Components/Header.vue";
import WelcomeSection from "@/Components/WelcomeSection.vue";
import MenuSection from "@/Components/MenuSection.vue";
import ReviewSection from "@/Components/ReviewSection.vue";
import Vibe from "@/Components/Vibe.vue";
import { welcome } from "./../constants/constants.json";
import PopularDishes from "@/Components/PopularDishes.vue";
import Footer from "@/Components/Footer.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <div class="container px-10 py-[1.5rem] max-w-[95%] mx-auto flex flex-col">
        <Header />
        <WelcomeSection
            :header="welcome.header"
            :text="welcome.text"
            :button-text="welcome.textButton"
        />
        <MenuSection />
        <ReviewSection />
        <Vibe />
        <PopularDishes />
        <Footer />
    </div>
</template>

<style></style>
