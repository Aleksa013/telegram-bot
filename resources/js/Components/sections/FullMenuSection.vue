<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import SectionsHeader from "../common/SectionsHeader.vue";
import SectionsText from "../common/SectionsText.vue";

const activeList = ref([]);

const changeActiveList = async (value) => {
    const list = await axios.get("http://127.0.0.1:8000/api/menu/" + value);
    activeList.value = list.data;
};

onMounted(async () => {
    const drink = await axios.get("http://127.0.0.1:8000/api/menu/drink");
    activeList.value = drink.data;
});
</script>
<template>
    <section class="bg-light_bg flex flex-col relative my-5 py-5">
        <div
            class="flex justify-between w-1/5 mx-auto absolute top-0 left-[40%]"
        >
            <Label
                class="bg-red-950 text-light_bg p-2 rounded-sm cursor-pointer hover:text-primary_orange"
                @click="changeActiveList('pizza')"
                >Pizza</Label
            >
            <Label
                class="bg-red-950 text-light_bg p-2 rounded-sm cursor-pointer hover:text-primary_orange"
                @click="changeActiveList('drink')"
                >Drink</Label
            >
            <Label
                class="bg-red-950 text-light_bg p-2 rounded-sm cursor-pointer hover:text-primary_orange"
                @click="changeActiveList('dish')"
                >Italian food</Label
            >
        </div>

        <div
            class="flex flex-col w-5/6 m-auto p-5 bg-red-50 border-2 border-red-950 rounded-sm"
        >
            <div
                v-for="product in activeList"
                class="w-auto h-[8em] m-2 flex justify-between items-center px-7 border-b-2 border-red-900"
            >
                <h4 class="text-[2em]">{{ product.name }}</h4>
                <SectionsText class="text-[1.5em]">{{
                    product.ingredients
                }}</SectionsText>
                <img
                    :src="
                        'http://127.0.0.1:5173/resources/assets/img/images/' +
                        product.image_path
                    "
                    :alt="product.name"
                    class="w-20 h-20 rounded-full object-cover"
                />
            </div>
        </div>
    </section>
</template>
