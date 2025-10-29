<script setup>
import { ref } from "vue";
import axios from "axios";
import { popularDishes } from "./../constants/constants.json";
import Label from "./Label.vue";
import SectionsHeader from "./SectionsHeader.vue";
import SectionsText from "./SectionsText.vue";
import PrimaryButton from "./PrimaryButton.vue";
import DishArticle from "./DishArticle.vue";
import { onMounted } from "vue";

const dishes = ref([]);

onMounted(async () => {
    const { data } = await axios.get("http://127.0.0.1:8000/api/menu/dish");
    dishes.value = data;
    console.log(data);
});
</script>
<template>
    <section class="flex flex-col items-center">
        <Label class="w-[5%]">Menu</Label>
        <SectionsHeader class="text-dark_bg">{{
            popularDishes.header
        }}</SectionsHeader>
        <SectionsText class="w-1/2 text-center mb-10">{{
            popularDishes.description
        }}</SectionsText>
        <div class="flex justify-between w-1/2 mb-8">
            <DishArticle
                v-for="(dish, i) of dishes"
                :key="i"
                :count="i"
                :description="dish.ingredients"
                :price="dish.price"
                :image-path="dish.image_path"
                :name="dish.name"
            ></DishArticle>
        </div>
        <PrimaryButton
            class="w-1/8 py-2 px-5 border-primary_orange border-2 hover:bg-primary_orange hover:text-light_bg"
            >{{ popularDishes.buttonText }}</PrimaryButton
        >
    </section>
</template>
