<script setup lang="js">
const props = defineProps({ list: [] });
console.log(props.list);
</script>
<template>
    <nav>
        <ul class="text-white_bg flex justify-center gap-5">
            <li v-for="i in list">
                <a :href="i">{{ i }}</a>
            </li>
        </ul>
    </nav>
</template>
