<script lang="js" setup>
import ListItem from './cards/ListItem.vue';
const props = defineProps({
    header: String,
    list: Array,
    count: Number
});
</script>
<template>
    <div class="flex flex-col">
        <h4 class="w-auto my-3 font-sans text-[3em] text-dark_bg">
            {{ props.header }}
        </h4>
        <ul>
            <li v-for="(item, i) in props.list">
                <ListItem :item v-if="i < props.count" />
            </li>
        </ul>
    </div>
</template>
