<script setup>
defineProps({
    description: String,
    iconPath: String,
});
</script>
<template>
    <div
        class="w-auto mr-3 p-2 flex flex-col justify-center items-center border-8 border-gray-700"
    >
        <img
            :src="iconPath"
            :alt="description"
            class="w-[2em] h-[2em] mt-1 mx-2"
        />
        <p class="font-serif text-light_bg text-[1em] font-semibold">
            {{ description }}
        </p>
    </div>
</template>
