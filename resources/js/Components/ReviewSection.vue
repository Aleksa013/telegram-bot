<script setup>
import { review } from "./../constants/constants.json";
import ReviewItem from "./ReviewItem.vue";
import { onMounted, ref } from "vue";
import axios from "axios";

const reviews = ref([]);

onMounted(async () => {
    const { data } = await axios.get("http://127.0.0.1:8000/api/reviews");
    reviews.value = data;
});
</script>
<template>
    <section class="flex flex-col">
        <span
            class="w-[5rem] py-2 border-t-2 border-b-2 border-primary_orange text-light_bg font-sans font-semibold"
            >Testimonial</span
        >
        <h4 class="w-auto my-3 font-serif text-[3em] text-light_bg">
            {{ review.header }}
        </h4>
        <p class="w-auto my-3 font-serif text-[1.5em] text-light_bg">
            {{ review.description }}
        </p>

        <ReviewItem
            v-for="review in props.reviews"
            :key="review.id"
            :review="review"
            :user="user"
        />
    </section>
</template>
