<script setup>
import WelcomeSection from "@/Components/sections/WelcomeSection.vue";
import MenuSection from "@/Components/sections/MenuSection.vue";
import ReviewSection from "@/Components/sections/ReviewSection.vue";
import Vibe from "@/Components/sections/Vibe.vue";
import { welcome } from "./../constants/constants.json";
import PopularDishes from "@/Components/sections/PopularDishes.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <WelcomeSection
        :header="welcome.header"
        :text="welcome.text"
        :button-text="welcome.textButton"
    />
    <MenuSection />
    <ReviewSection />
    <Vibe />
    <PopularDishes />
</template>

<style></style>
