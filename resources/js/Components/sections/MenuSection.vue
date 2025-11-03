<script lang="js" setup>
import { onMounted, ref } from 'vue';
import axios from 'axios';
import DishCard from './../cards/DishCard.vue';
import {menuSection} from './../../constants/constants.json';
import EntityList from './../cards/EntityList.vue';
import Label from './../common/Label.vue';


const drinkList = ref([]);
const dishList = ref([]);
const pizzaList = ref([]);

onMounted(async()=>{
    const drink = await(axios.get('http://127.0.0.1:8000/api/menu/drink'));
    const dish = await(axios.get('http://127.0.0.1:8000/api/menu/dish'));
    const pizza = await(axios.get('http://127.0.0.1:8000/api/menu/pizza'));
    drinkList.value = drink.data;
    dishList.value = dish.data;
    pizzaList.value = pizza.data;
})
</script>
<template>
    <section class="px-5 py-3">
        <Label class="w-[5%]">Menu</Label>
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
