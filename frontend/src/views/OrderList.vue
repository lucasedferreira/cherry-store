<template>
  <div class="container text-center">
    <h1>Orders</h1>
    <LoadingSpinner v-if="loading" style="margin-top: 15px;" />
    <table class="table text-left" v-if="!loading">
      <thead>
        <tr>
          <th>Name</th>
          <th>Quantity of Products</th>
          <th>Subtotal</th>
          <th>Tax Total</th>
          <th>Total</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <th class="text-center" colspan="6" v-show="orders.length === 0">
          Puts, it looks like you haven't created any orders yet :(
          <br />
          <a class="link" @click="navigateToMakeOrder">Click here</a>
          to solve it!
        </th>
        <tr :key="order.id" v-for="order in orders">
          <td>#{{ order.id }}</td>
          <!-- <td>{{ order.created_at }}</td> -->
          <td>{{ getProductsQuantity(order) }}</td>
          <td>R$ {{ order.subtotal }}</td>
          <td>R$ {{ order.tax_total }}</td>
          <td>R$ {{ order.total }}</td>
          <td style="width: 18%">
            <a class="action-button" @click="open(order)">
              <img :src="openIcon" width="20" alt="open" />
            </a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import LoadingSpinner from "@/components/LoadingSpinner.vue";
import openIcon from "@/assets/icons/open.svg";
import OrderService from "../services/Order";
import { toast } from "vue3-toastify";

export default {
  name: "OrderList",
  components: {
    LoadingSpinner,
  },
  setup() {
    return {
      openIcon,
    };
  },
  data() {
    return {
      orders: [],
      loading: true,
    };
  },
  async mounted() {
    if (this.$route.params.receivedNewOrder) {
      toast(`Order #${this.$route.params.receivedNewOrder} created.`, {
        autoClose: 3000,
        type: "success",
        transition: "slide",
      });
    }

    const orderService = new OrderService();
    this.orders = await orderService.getOrders();
    this.loading = false;
  },
  methods: {
    navigateToMakeOrder() {
      this.$router.push({ name: "MakeOrder" });
    },
    getProductsQuantity(order) {
      return order.products.reduce((quantity, item) => {
        return quantity + parseInt(item.product_quantity);
      }, 0);
    },
    open(order) {
      this.$router.push({
        name: "OrderProducts",
        params: { order: JSON.stringify(order) },
      });
    },
  },
};
</script>

<style lang="scss" scoped>
.link {
  color: coral;
  cursor: pointer;
}
</style>
