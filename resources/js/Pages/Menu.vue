<script setup>
import FullMenuSection from "@/Components/sections/FullMenuSection.vue";
import Offers from "@/Components/sections/Offers.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <FullMenuSection />
    <Offers />
</template>
