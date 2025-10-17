<script lang="js" setup>
import PrimaryButton from './PrimaryButton.vue';

const props = defineProps({
    header: String,
    description:String,
    picturePath: String,
    name:String,
    textButton:String | null,
});
console.log(props);
</script>
<template>
    <div class="w-[30%] px-3 py-5 flex flex-col justify-start">
        <h5
            class="w-auto font-serif text-40 font-regular leading-[56px] text-dark_bg"
        >
            {{ props.header }}
        </h5>
        <p class="w-auto font-sans text-20 text-primary_gray">
            {{ props.description }}
        </p>
        <img :src="props.picturePath" :alt="props.name" class="w-[75%] my-10" />
        <PrimaryButton
            v-if="props.textButton"
            class="w-[43%] py-2 px-5 border-primary_orange border-2 hover:bg-primary_orange hover:text-light_bg"
            >{{ props.textButton }}</PrimaryButton
        >
    </div>
</template>
<style lang="css" scoped></style>
