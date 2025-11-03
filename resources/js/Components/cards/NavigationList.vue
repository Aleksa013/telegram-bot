<script setup lang="js">
const props = defineProps({ list: Array });
</script>
<template>
    <nav>
        <ul class="text-white_bg flex justify-center gap-5">
            <li v-for="i in list">
                <a
                    :href="i == 'Home' ? '/' : i.split(' ')[0].toLowerCase()"
                    class="hover:text-primary_orange"
                >
                    {{ i }}
                </a>
            </li>
        </ul>
    </nav>
</template>
