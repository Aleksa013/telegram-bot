<script setup>
const vCapitalizeWords = {
    mounted(el) {
        if (el.textContent) {
            const text = el.textContent
                .split(" ")
                .map(
                    (word) =>
                        word.charAt(0).toUpperCase() +
                        word.slice(1).toLowerCase()
                )
                .join(" ");
            el.textContent = text;
        }
    },
};
</script>
<template>
    <h4 v-capitalize-words class="w-auto my-3 font-serif text-[3em]">
        <slot></slot>
    </h4>
</template>
