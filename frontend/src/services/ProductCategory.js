import axios from "axios";

export default class ProductCategory {
  async getCategories() {
    const response = await axios.get("http://localhost:9000/product-category");
    return response.data;
  }

  async getByID(categoryID) {
    const response = await axios.get(
      `http://localhost:9000/product-category/${categoryID}`
    );
    return response.data;
  }

  async addCategory(category) {
    const response = await axios.post(
      "http://localhost:9000/product-category",
      category
    );
    return response.data;
  }

  async updateCategory(category) {
    await axios.put(
      `http://localhost:9000/product-category/${category.id}`,
      category
    );
  }

  async deleteCategory(categoryID) {
    await axios.delete(`http://localhost:9000/product-category/${categoryID}`);
  }
}
