<template>
    <v-container>
        <v-row justify="end" class="my-5 mr-5">
            <v-btn color="primary" to="/newProduct">Add Product</v-btn>
        </v-row>

        <v-card v-for="(product, idx) in products" :key="idx" class="ma-4" :to="`/products/${product.id}`">
            <v-card-title>
                {{ product.name }}
            </v-card-title>

            <v-card-text>
                {{ product.description }}
            
                <p v-if="product.categories.length" class="mt-5 text-caption font-weight-bold">Categories</p>
                <v-chip v-for="(category, idx) in product.categories" :key="idx">{{ category }}</v-chip>
            </v-card-text>

        </v-card>
    </v-container>
</template>
<script>
import Products from '../api/Products';
  export default {
    data: ()  => ({
        products: []
    }),

    created() {
        this.getProducts();
    },

    methods: {
        getProducts() {
            Products.getProducts().then((response) => {
                this.products = response.data.data
            })
        }
    }
  }
</script>