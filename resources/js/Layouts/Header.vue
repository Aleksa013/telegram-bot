<script setup lang="js">
import { ref } from 'vue';
import PrimaryButton from './../Components/common/PrimaryButton.vue';
import ApplicationLogo from './../Components/ApplicationLogo.vue';
import {navigation} from './../constants/constants.json';
import NavigationList from './../Components/cards/NavigationList.vue';
</script>
<template>
    <header class="flex flex-wrap justify-around items-center bg-dark_bg">
        <PrimaryButton
            class="block max-w-[25%] max-h-[3rem] px-3 py-2 border-primary_orange border-2 bg-dark_bg text-white_bg hover:border-orange-100 hover:text-primary_orange focus:border-orange-100 focus:text-primary_orange"
        >
            Call - 123 456 789
        </PrimaryButton>
        <ApplicationLogo class="block max-w-[40%] max-h-[6.5rem] mx-11" />
        <PrimaryButton
            class="block max-w-[25%] max-h-[3rem] px-3 py-2 border-primary_orange border-2 bg-primary_orange text-dark_bg hover:border-orange-100 hover:text-primary_gray focus:border-orange-100 focus:text-primary_gray"
        >
            Reservation
        </PrimaryButton>
        <NavigationList :list="navigation" class="w-[100%]" />
    </header>
</template>
<style lang="css" scoped>
.left {
    display: flex;
    justify-content: flex-start;
}
</style>
