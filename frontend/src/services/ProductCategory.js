import axios from "axios";

export default class ProductCategory {
  async getCategories() {
    const response = await axios.get("http://localhost:9000/product-category");
    return response.data;
  }

  async addCategory(category) {
    const response = await axios.post(
      "http://localhost:9000/product-category",
      category
    );
    return response.data;
  }
}
