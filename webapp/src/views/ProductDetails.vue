<template>
    <v-container>
        <v-dialog
        v-model="dialog"
        width="500"
        >
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                color="red lighten-2"
                dark
                v-bind="attrs"
                v-on="on"
                >
                Delete
                </v-btn>
            </template>

            <v-card>
                <v-card-title class="text-h5 grey lighten-2">
                    Are you sure ? 
                </v-card-title>

                <v-card-text>
                    This action is dangerous and irreversible!
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="error"
                        text
                        @click="deleteProduct"
                    >
                        Delete
                    </v-btn>
                    <v-btn color="success" text @click="dialog = false">Cancel</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
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
        dialog: false,
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

        },

        deleteProduct() {
            Products
                .deleteProduct(this.$route.params.id)
                .then(() => {
                    this.$router.push("/products");
                });
        }
    }
}
</script>