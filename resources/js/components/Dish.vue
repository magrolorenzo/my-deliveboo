<template>
<div>
    <h1>{{dishes[0].name}}</h1>

</div>
</template>

<script>
    export default {
        data(){
            return{
                dishes: []
            }
        },
        mounted() {
             axios
            .get('http://localhost:8000/api/dishes')
            .then((dishes) => {
                let dish = dishes.data.results;
                this.dishes = dish;
            console.log(dishes.data.results[0].name);
            });
        }
    }
</script>

<style scoped>
    h1{
        color: red;
    }
</style>