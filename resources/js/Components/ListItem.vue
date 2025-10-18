<script lang="js" setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
item:Object
});
const path = ref('http://127.0.0.1:5173/resources/assets/img/images/');
onMounted(()=>{
    path.value +=props.item.image_path;
});
</script>

<template>
    <div class="w-auto flex justify-between">
        <img
            :src="path"
            :alt="props.item.name"
            class="w-[2em] h-[2em] rounded-full mt-1 mx-2"
        />
        <div class="text_content w-[70%] text-start">
            <span class="font-serif text-[2em] font-semibold">{{
                props.item.name
            }}</span>
            <p class="font-sans text-[1.75em]">{{ props.item.ingredients }}</p>
        </div>
        <span class="price">{{ props.item.price }}</span>
    </div>
</template>
