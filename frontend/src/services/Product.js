import axios from "axios";

export default class Product {
  async addProduct(product) {
    const response = await axios.post("http://localhost:9000/product", product);
    return response.data;
  }

  async updateProduct(product) {
    await axios.put(
      `http://localhost:9000/product/${product.id}`,
      product
    );
  }

  async deleteProduct(productID) {
    await axios.delete(`http://localhost:9000/product/${productID}`);
  }
}
