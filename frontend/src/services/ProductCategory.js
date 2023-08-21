import axios from "axios";

export default class ProductCategory {
  async getCategories() {
    const response = await axios.get("http://localhost:9000/product-category");
    return response.data;
  }

  async addCategory(category) {
    await axios.post("http://localhost:9000/product-category", category);
  }
}
