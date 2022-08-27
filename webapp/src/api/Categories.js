import Api from "./Api";

export default {
  async getCategories() {
    return await Api().get("/categories");
  },
};
