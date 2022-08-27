import Vue from 'vue'
import VueRouter from 'vue-router'
import Products from '../views/Products.vue'
import ProductDetails from "../views/ProductDetails"
import NewProduct from "../views/NewProduct"

Vue.use(VueRouter)

const routes = [
  {
    path: "/",
    redirect: "/products"
  },
  {
    path: '/products',
    name: 'Products',
    component: Products,
  },
  {
    path: "/products/:id",
    component: ProductDetails
  },
  {
    path: "/newProduct",
    component: NewProduct,
  }
]

const router = new VueRouter({
  mode: 'history',
  routes
})

export default router
