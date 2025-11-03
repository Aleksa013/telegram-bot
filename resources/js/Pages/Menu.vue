<script setup>
import Offers from "@/Components/sections/Offers.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Offers />
</template>
