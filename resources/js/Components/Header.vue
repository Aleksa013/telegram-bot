<script setup lang="js">
import { ref } from 'vue';
import PrimaryButton from './PrimaryButton.vue';
import ApplicationLogo from './ApplicationLogo.vue';
import NavLink from './NavLink.vue';
import {navigation, social} from './../constants/constants.json';
import NavigationList from './NavigationList.vue';

const nav = ref(navigation);
const socialList = ref(social);
console.log(navigation);
</script>
<template>
    <header
        class="flex flex-wrap justify-around items-center px-10 py-[1.5rem] max-w-[95%] mx-auto bg-dark_bg"
    >
        <PrimaryButton
            class="block max-w-[25%] max-h-[3rem] px-3 py-2 border-primary_orange border-2 bg-dark_bg text-white_bg"
        >
            Call - 123 456 789
        </PrimaryButton>
        <ApplicationLogo class="block max-w-[40%] max-h-[6.5rem] mx-11" />
        <PrimaryButton
            class="block max-w-[25%] max-h-[3rem] px-3 py-2 border-primary_orange border-2 bg-primary_orange text-dark_bg"
        >
            Reservation
        </PrimaryButton>
        <NavigationList :list="navigation" class="w-[60%]" />
        <NavigationList :list="social" class="w-[40%]" />
    </header>
</template>
