<script setup>
import { review } from "./../constants/constants.json";
import ReviewItem from "./ReviewItem.vue";
import { onMounted, ref } from "vue";
import axios from "axios";

const reviews = ref([]);

const vCapitalizeWords = {
    mounted(el) {
        if (el.textContent) {
            const text = el.textContent
                .split(" ")
                .map(
                    (word) =>
                        word.charAt(0).toUpperCase() +
                        word.slice(1).toLowerCase()
                )
                .join(" ");
            el.textContent = text;
        }
    },
};

onMounted(async () => {
    const { data } = await axios.get("http://127.0.0.1:8000/api/reviews");
    reviews.value = data;
});
</script>
<template>
    <section class="flex flex-col bg-dark_bg p-12">
        <span
            class="w-[5rem] py-2 border-t-2 border-b-2 border-primary_orange text-light_bg font-sans font-semibold"
            >Testimonial</span
        >
        <h4
            v-capitalize-words
            class="w-auto my-3 font-serif text-[3em] text-light_bg"
        >
            {{ review.header }}
        </h4>
        <p class="w-auto my-3 font-serif text-[1.5em] text-light_bg mb-12">
            {{ review.description }}
        </p>
        <div class="flex justify-evenly">
            <ReviewItem
                v-if="reviews.length > 0"
                v-for="review in reviews"
                :key="review.id"
                :review="review"
            />
            <div v-else>
                <p>No reviews found</p>
            </div>
        </div>
    </section>
</template>
