<script setup>
import { offers } from "@/constants/constants.json";
import SectionsText from "../common/SectionsText.vue";
import SectionsHeader from "../common/SectionsHeader.vue";
import Label from "../common/Label.vue";
import AdvantagesItem from "../cards/AdvantagesItem.vue";
</script>

<template>
    <section class="px-8 bg-dark_bg flex justify-between">
        <div class="w-1/3 flex flex-col items-start">
            <Label class="text-white">{{ offers.title }}</Label>
            <SectionsHeader class="text-white ml-4">{{
                offers.header
            }}</SectionsHeader>
            <SectionsText class="text-white ml-4">{{
                offers.description
            }}</SectionsText>
        </div>
        <div class="w-2/3 p-10 flex flex-wrap justify-between items-center">
            <AdvantagesItem
                v-for="advantage in offers.advantages"
                :key="advantage.description"
                :description="advantage.description"
                :iconPath="advantage.iconPath"
            />
        </div>
    </section>
</template>
