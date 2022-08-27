<template>
    <v-container>
        <p class="text-h4">
            {{ product.name }}
        </p>

        <p class="font-weight-black text-body-2">Price: {{ product.price }}</p>

        <p class="">{{ product.description }}</p>

        <p class="text-h6">Categories</p>
        <p v-if="!product.categories.length">None</p>
        <template v-else>
            <v-chip v-for="(category, idx) in product.categories" :key="idx">
                {{category}}
            </v-chip>
        </template>

    </v-container>
</template>
<script>
import Products from "../api/Products";

export default {
    data: () => ({
        product: {},
    }),

    created() {
        this.getProduct();
    },

    methods: {
        getProduct() {
            let id = this.$route.params.id;
            Products.getProduct(id).then((response) => {
                this.product = response.data.data;
            })

        }
    }
}
</script>