<script lang="js" setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';
import DishCard from './DishCard.vue';
import {menuSection} from './../constants/constants.json';
import EntityList from './EntityList.vue';

const drinkList = ref([]);
const dishList = ref([]);
const pizzaList = ref([]);

onMounted(async()=>{
    const {data} = await(axios.get('http://127.0.0.1:8000/api/menu/drink'));
    const dish = await(axios.get('http://127.0.0.1:8000/api/menu/dish'));
    const pizza = await(axios.get('http://127.0.0.1:8000/api/menu/pizza'));
    drinkList.value = data;
    dishList.value = dish.data;
    pizzaList.value = pizza.data;
    console.log(data);
})
</script>
<template>
    <section class="px-5 py-3">
        <h4
            class="w-[5%] mx-5 my-3 font-sans font-semibold text-center size-6 border-y-2 border-primary_orange"
        >
            Menu
        </h4>
        <div class="flex">
            <DishCard
                :header="menuSection.card.header"
                :description="menuSection.card.description"
                :picture-path="menuSection.card.picturePath"
                :text-button="menuSection.card.textButton"
                :name="menuSection.card.name"
            />
            <div class="flex flex-col w-[70%] ml-3">
                <EntityList :header="'Beverage'" :list="drinkList" :count="4" />
                <EntityList :header="'Dish'" :list="dishList" :count="4" />
                <EntityList :header="'Pizza'" :list="pizzaList" :count="2" />
            </div>
        </div>
    </section>
</template>
<style lang="css" scoped></style>
