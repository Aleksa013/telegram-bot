<script setup>
import { footer } from "./../constants/constants.json";
import ApplicationLogo from "./ApplicationLogo.vue";
import Label from "./Label.vue";
</script>
<template>
    <footer class="flex justify-between bg-dark_bg text-light_bg p-16">
        <div class="flex flex-col">
            <span class="tag">{{ footer.tag }}</span>
            <Label>Contact</Label>
            <span>{{ footer.address }}</span>
            <span>{{ footer.phone }}</span>
            <span>{{ footer.email }}</span>
        </div>
        <div class="flex flex-col">
            <ApplicationLogo />
        </div>
        <div class="flex flex-col">
            <Label>Working Hours</Label>
            <p>Mon – Fri: <span>7.00am – 6.00pm</span></p>
            <p>Sat: <span>7.00am – 6.00pm</span></p>
            <p>Sun: <span>8.00am – 6.00pm</span></p>
        </div>
    </footer>
</template>
