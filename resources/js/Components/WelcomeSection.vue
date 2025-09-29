<script setup lang="js">
import PrimaryButton from './PrimaryButton.vue';
const content = defineProps({
    header: String,
    text: String,
    buttonText: String
})

const goToMenu = ()=> {
    return route('menu')
}
</script>

<template>
    <section class="welcome bg-dark_bg flex">
        <div class="content flex justify-center flex-col w-[50%]">
            <h2
                class="text-white_bg font-normal text-4xl header font-serif w-[50%] my-10"
            >
                {{ content.header }}
            </h2>
            <p class="text-white_bg w-[75%] my-8">{{ content.text }}</p>

            <PrimaryButton
                @click="goToMenu"
                class="w-[10rem] my-8 px-[2.8em] py-2 text-base border-primary_orange border-2 text-primary_orange hover:bg-primary_gray hover:text-orange-100 focus:bg-primary_gray focus:text-orange-100 active:bg-primary_gray active:text-orange-100"
                >{{ content.buttonText }}</PrimaryButton
            >
        </div>
        <img
            src="../../assets/img/images/welcome-bg.png"
            alt="beautufull place"
        />
    </section>
</template>

<style lang="css" scoped>
.welcome {
    padding: 5% 5% 0;
}
/* .picture {
    width: 50%;

    background-image: url("../../assets/img/images/welcome-bg.png");
    background-size: cover;
    background-repeat: no-repeat;
} */
</style>
