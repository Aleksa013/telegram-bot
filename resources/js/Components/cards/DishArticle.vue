<script setup>
import { computed, ref } from "vue";

const props = defineProps({
    imagePath: String,
    name: String,
    price: String,
    description: String,
    count: Number,
});

const convertedPrice = computed(() => {
    return Number(props.price).toFixed() / 50;
});

const startPath = ref("http://127.0.0.1:5173/resources/assets/img/images/");
</script>
<template>
    <article v-if="count < 10 && count > 5" class="w-1/3 mx-3">
        <div
            class="h-[280px] object-cover"
            :style="{ backgroundImage: `url(${startPath}${props.imagePath})` }"
        ></div>
        <div
            class="flex justify-between items-center w-auto my-3 font-serif border-b-2 border-primary_gray text-[1rem] text-semibold"
        >
            <span>
                {{ props.name }}
            </span>
            <span class="text-[1.5rem]">{{ convertedPrice + "BGN" }}</span>
        </div>

        <p class="text-[0.75rem] w-auto font-sans text-primary_gray">
            {{ props.description }}
        </p>
    </article>
</template>
