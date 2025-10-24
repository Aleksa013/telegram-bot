<script setup>
const props = defineProps({
    review: Object,
    user: Object,
});
</script>
<template>
    <div class="flex flex-col">
        <div>
            <img :src="props.review.image" :alt="props.review.name" />
            <div>
                <span>{{ props.review.name }}</span>
                <p>{{ props.user.city }}</p>
            </div>
        </div>
        <h4 class="w-auto my-3 font-serif text-[3em] text-light_bg">
            {{ props.review.text }}
        </h4>
    </div>
</template>
