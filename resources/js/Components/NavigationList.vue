<script setup lang="js">
const props = defineProps({ list: [] });
</script>
<template>
    <nav>
        <ul class="text-white_bg flex justify-center gap-5">
            <li v-for="i in list">
                <a :href="i.split(' ')[0]" class="hover:text-primary_orange">{{
                    i
                }}</a>
            </li>
        </ul>
    </nav>
</template>
