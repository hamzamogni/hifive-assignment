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
            <v-chip 
                close 
                v-for="(category, idx) in product.categories" 
                :data-id="category.id" 
                :key="idx"
                @click:close="detachCategoryFromProduct(category.id)"
            >{{ category.name }}</v-chip>

        </template>

        <v-row class="my-5">
            <v-btn 
                v-if="!addCategory"
                @click="addCategory = !addCategory"
                text 
                color="primary"
            >Add Category</v-btn>
            <v-select 
                v-else 
                label="Choose a category"
                v-model="selectedCategory"
                :items="allCategories" 
                item-text="name" 
                item-value="id" 
                @input="attachCategoryToProduct"
            ></v-select>
        </v-row>
    </v-container>
</template>
<script>
import Products from "../api/Products";
import Categories from "../api/Categories";

export default {
    data: () => ({
        dialog: false,
        product: {
            categories: {}
        },
        addCategory: false,
        selectedCategory: null,
        categories: [],
    }),

    created() {
        this.getProduct();
        this.getCategories();
    },

    computed: {
        // We flatten the categories to show them all
        allCategories() {
            let flatCategories = []

            this.categories.forEach(element => {
                flatCategories.push(element);
                
                element.children.forEach(child => {
                    flatCategories.push(child);
                });
            });

            console.log(flatCategories);

            return flatCategories;
        }
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
        },

        getCategories(){
            Categories
                .getCategories()
                .then((response) => {
                    this.categories = response.data.data;
                })
        },

        attachCategoryToProduct(category) {
            Products
                .attachCategory(this.$route.params.id, category)
                .then(() => {
                    this.getProduct();
                    this.addCategory = false;
                    this.selectedCategory = null;
                })

            console.log("qsfmlkj");
        },

        detachCategoryFromProduct(category_id) {
            Products
                .detachCategory(this.$route.params.id, category_id)
                .then(() => {
                    this.getProduct();
                })
        }
    }
}
</script>