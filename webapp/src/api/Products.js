import Api from "./Api";

export default {
  async getProducts() {
    return await Api().get("/products");
  },

  async getProduct(id) {
    return await Api().get(`/products/${id}`);
  },

  async createProduct(data) {
    return await Api().post("/products", {
      name: data.name,
      price: data.price,
      description: data.description,
    });
  },

  async deleteProduct(id) {
    return await Api().delete(`/products/${id}`);
  },

  async attachCategory(product_id, category_id) {
    return await Api().post(
      `/products/${product_id}/categories/${category_id}`
    );
  },

  async detachCategory(product_id, category_id) {
    return await Api().delete(
      `/products/${product_id}/categories/${category_id}`
    );
  },
};
