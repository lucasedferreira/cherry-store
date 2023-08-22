import axios from "axios";

export default class Order {
  async getOrders() {
    const response = await axios.get("http://localhost:9000/order");
    return response.data;
  }

  async createOrder(products) {
    const response = await axios.post("http://localhost:9000/order", {
      products,
    });
    return response.data;
  }
}
