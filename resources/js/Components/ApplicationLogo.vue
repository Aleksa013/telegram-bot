<script setup lang="js">
import logo from '../../assets/img/icons/logoGreat.svg';
</script>

<template>
    <img :src="logo" alt="Logo" />
</template>

<style lang="css" scoped>
div {
    background-image: url(logo);
    background-size: cover;
    background-repeat: no-repeat;
}
</style>
