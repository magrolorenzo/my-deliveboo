<template>
    <div>
        <div class="card">
            <img
                :src="url_base + dishes[0].img_cover"
                alt=""
                class="card-img-top"
            />
            <div class="card-body">
                <h1>{{ dishes[0].name }}</h1>
                <p class="card-text">
                    {{ dishes[0].ingredients }}
                </p>
                <p class="card-text">
                    {{ dishes[0].description }}
                </p>
                <p class="card-text">{{ dishes[0].unit_price }} €</p>
                <p class="card-text">
                    {{ dishes[0].visible }}
                </p>
                <a href="" class="btn btn-outline-success btn-sm">Read More</a>
                <a href="" class="btn btn-outline-danger btn-sm"
                    ><i class="far fa-heart"></i
                ></a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            dishes: [],
            url_base: "http://localhost:8000/storage/"
        };
    },
    mounted() {
        axios.get("http://localhost:8000/api/dishes").then(dishes => {
            let dish = dishes.data.results;
            this.dishes = dish;
            console.log(dishes.data.results[0].name);
        });
    }
};
</script>

<style scoped></style>
