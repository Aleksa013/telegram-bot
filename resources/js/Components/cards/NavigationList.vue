<script setup lang="js">
import { RouterLink } from 'vue-router';

const props = defineProps({ list: Array });
</script>
<template>
    <nav>
        <ul class="text-white_bg flex justify-center gap-5">
            <li v-for="i in list">
                <RouterLink
                    :to="i == 'Home' ? '/' : i.split(' ')[0].toLowerCase()"
                    class="hover:text-primary_orange"
                >
                    {{ i }}
                </RouterLink>
            </li>
        </ul>
    </nav>
</template>
<style scope>
.router-link-active {
    color: #e1b168;
}
</style>
