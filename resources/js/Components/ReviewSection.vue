<script setup>
import { review } from "./../constants/constants.json";
import ReviewItem from "./ReviewItem.vue";
import Label from "./Label.vue";
import SectionsHeader from "./SectionsHeader.vue";
import { onMounted, ref } from "vue";
import axios from "axios";
import SectionsText from "./SectionsText.vue";

const reviews = ref([]);

onMounted(async () => {
    const { data } = await axios.get("http://127.0.0.1:8000/api/reviews");
    reviews.value = data;
});
</script>
<template>
    <section class="flex flex-col bg-dark_bg p-12">
        <Label class="text-light_bg w-[5rem] py-2">Testimonial</Label>
        <SectionsHeader class="text-light_bg text-[3em]">
            {{ review.header }}
        </SectionsHeader>
        <SectionsText class="text-light_bg">
            {{ review.description }}</SectionsText
        >
        <div class="flex justify-evenly mt-8">
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
