<script lang="js" setup>
import PrimaryButton from './PrimaryButton.vue';

const props = defineProps({
    header: String,
    description:String,
    picturePath: String,
    name:String,
    textButton:{
        type:String,
        required: false
    },
});
</script>
<template>
    <div class="w-[45%] px-3 py-5 flex flex-col justify-start">
        <h5
            class="w-auto font-serif text-[40px] font-regular leading-[56px] text-dark_bg"
        >
            {{ props.header }}
        </h5>
        <p class="w-auto font-sans text-[20px] text-primary_gray">
            {{ props.description }}
        </p>
        <img :src="props.picturePath" :alt="props.name" class="w-[75%] my-10" />
        <PrimaryButton
            v-if="props.textButton"
            class="w-[29%] py-2 px-5 border-primary_orange border-2 hover:bg-primary_orange hover:text-light_bg"
            >{{ props.textButton }}</PrimaryButton
        >
    </div>
</template>
<style lang="css" scoped></style>
