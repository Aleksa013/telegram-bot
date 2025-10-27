<script setup>
import { onMounted, ref } from "vue";
import { defaultData } from "@/constants/constants.json";

const props = defineProps({
    review: Object,
});

const user = ref({});
const city = ref("");

onMounted(async () => {
    console.log("http://127.0.0.1:8000/api/user/" + props.review.user_id);
    const { data } = await axios.get(
        "http://127.0.0.1:8000/api/user/" + props.review.user_id
    );
    user.value = data;
    city.value = data.addresses.city;
    console.log(user.value);
});
</script>
<template>
    <div class="flex flex-col w-1/4 min-h-60 bg-primary_gray px-4 py-5">
        <div class="flex border-b-2 border-dark_bg pt-2 pb-6">
            <img
                :src="user.image ?? defaultData.avaPath"
                alt="avatar"
                class="w-16 h-16 rounded-full"
            />
            <div class="flex flex-col mx-3 px-3">
                <span class="font-serif text-light_bg text-[24px]">{{
                    user.name
                }}</span>
                <p class="font-sans text-primary_orange">
                    {{ city ?? "Your city" }}
                </p>
            </div>
        </div>
        <h4 class="w-auto my-3 font-serif text-[16px] text-light_bg">
            {{ props.review.text }}
        </h4>
    </div>
</template>
