<script lang="js" setup>
import PrimaryButton from './PrimaryButton.vue';
import SectionsHeader from './SectionsHeader.vue';
import SectionsText from './SectionsText.vue';

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
        <SectionsHeader class="text-dark_bg">{{ props.header }}</SectionsHeader>
        <SectionsText class="text-primary_gray">
            {{ props.description }}</SectionsText
        >
        <img :src="props.picturePath" :alt="props.name" class="w-[75%] my-10" />
        <PrimaryButton
            v-if="props.textButton"
            class="w-[29%] py-2 px-5 border-primary_orange border-2 hover:bg-primary_orange hover:text-light_bg"
            >{{ props.textButton }}</PrimaryButton
        >
    </div>
</template>
<style lang="css" scoped></style>
