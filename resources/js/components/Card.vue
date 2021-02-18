<template>
    <dish v-for="dish in dishes" />
</template>

<script>
import Dish from "./../components/Dish.vue";
export default {
    name: "Card",
    components: {
        Dish
    }
};
</script>
