<script setup>
import { footer } from "./../constants/constants.json";
import ApplicationLogo from "./ApplicationLogo.vue";
import Label from "./Label.vue";
</script>
<template>
    <footer class="flex justify-between bg-dark_bg text-light_bg p-16">
        <div class="flex flex-col p-3">
            <span class="tag mx-4 mb-5">{{ footer.tag }}</span>
            <Label>Contact</Label>
            <span class="mx-4 mt-5">{{ footer.address }}</span>
            <span class="mx-4 text-primary_orange">{{ footer.phone }}</span>
            <span class="mx-4 text-primary_orange">{{ footer.email }}</span>
        </div>
        <div class="flex flex-col">
            <ApplicationLogo />
        </div>
        <div class="flex flex-col items-end">
            <Label class="mt-14 px-10">Working Hours</Label>
            <p class="text-primary_orange mt-5">
                Mon – Fri:
                <span class="text-light_bg">7.00am – 6.00pm</span>
            </p>
            <p class="text-primary_orange">
                Sat: <span class="text-light_bg">7.00am – 6.00pm</span>
            </p>
            <p class="text-primary_orange">
                Sun: <span class="text-light_bg">8.00am – 6.00pm</span>
            </p>
        </div>
    </footer>
</template>
