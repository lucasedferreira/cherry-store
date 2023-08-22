<template>
  <div class="container">
    <h1>Order #{{ order.id }}</h1>
    <table class="table" v-if="order.products">
      <thead>
        <tr>
          <th>Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Tax</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <tr :key="item.id" v-for="item in order.products">
          <td>{{ item.product_name }}</td>
          <td>{{ item.product_quantity }}</td>
          <td>R$ {{ item.product_price }}</td>
          <td>{{ item.product_tax }}%</td>
          <td>R$ {{ item.total }}</td>
        </tr>
        <tr>
          <td class="font-weight-bold">TOTAL:</td>
          <td>{{ getTotalQuantity() }}</td>
          <td>R$ {{ order.subtotal }}</td>
          <td>R$ {{ order.tax_total }}</td>
          <td>R$ {{ order.total }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "OrderProducts",
  components: {},
  setup() {},
  data() {
    return {
      order: {},
    };
  },
  async mounted() {
    if (!this.$route.params.order) {
      this.$router.push({ name: "OrderList" });
      return;
    }
    this.order = JSON.parse(this.$route.params.order);
  },
  methods: {
    getTotalQuantity() {
      return this.order.products.reduce((quantity, item) => {
        return quantity + parseInt(item.product_quantity);
      }, 0);
    },
  },
};
</script>

<style lang="scss" scoped>
tbody tr:last-child {
  background-color: #dea2090f;
}
</style>
