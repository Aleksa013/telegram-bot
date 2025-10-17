<script lang="js" setup>
import DishCard from './DishCard.vue';
import {menuSection} from './../constants/constants.json';
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
        </div>
    </section>
</template>
<style lang="css" scoped></style>
