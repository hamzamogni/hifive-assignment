<template>
    <v-container>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
        <v-text-field
            v-model="name"
            :counter="10"
            :rules="nameRules"
            label="Name"
            required
        ></v-text-field>

        <v-text-field
            v-model="price"
            :rules="priceRules"
            label="Price"
            type="number"
            required
        ></v-text-field>

        <v-textarea
            v-model="description"
            :rules="descriptionRules"
            label="Description"
            auto-grow
        ></v-textarea>

        <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="submitProduct"
        >
            Validate
        </v-btn>
    </v-form>
    <v-alert type="error" class="mt-4" v-if="showAlert">
        {{ alert }}
    </v-alert>
    </v-container>
    
</template>
<script>
import Products from '../api/Products';
  export default {
    data: () => ({
      showAlert: false,
      alert: "sqdf",

      valid: true,

      name: '',
      nameRules: [
        v => !!v || 'Name is required',
      ],
      
      price: '',
      priceRules: [
        v => !!v || 'Price is required',
        v => !isNaN(v) || 'Price must be valid',
      ],

      description: "",
      descriptionRules: [
        v => !!v || 'Description is required',
      ]
    }),

    methods: {
      validate () {
        return this.$refs.form.validate()
      },

      submitProduct() {
          if (this.validate()) {
              Products.createProduct({
                  name: this.name,
                  price: this.price,
                  description: this.description,
              })
              .then(() => {
                  this.$router.push("/products")
              })
              .catch((error) => {
                  this.showAlert = true;
                  this.alert = error.response.data.message
                  console.log(error);
              })
          }
      }
    },
  }
</script>