<script setup>
import { ref } from "vue";
import SectionsHeader from "./SectionsHeader.vue";
import SectionsText from "./SectionsText.vue";

defineProps({
    imagePath: String,
    name: String,
    price: String,
    description: String,
    count: Number,
});

const startPath = ref("http://127.0.0.1:5173/resources/assets/img/images/");
</script>
<template>
    <article v-if="count < 10 && count > 5" class="w-1/5">
        <div
            class="h-[280px] bg-cover bg-no-repeat bg-center"
            :style="{ backgroundImage: `url(${startPath}${imagePath})` }"
        ></div>
        <SectionsHeader class="text-[1rem] border-b-2 border-primary_gray">{{
            name
        }}</SectionsHeader>
        <SectionsText class="text-[0.75rem]">{{ description }}</SectionsText>
    </article>
</template>
