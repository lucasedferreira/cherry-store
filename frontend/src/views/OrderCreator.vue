<template>
  <div class="container">
    <div class="row">
      <div class="col-8">
        <h1>Products</h1>
        <ul class="list-group list-group-flush">
          <li
            class="list-group-item"
            :key="category.id"
            v-for="category in categories"
          >
            <div class="item-title">{{ category.name }}</div>
            <div
              :key="product.id"
              v-for="product in category.products"
              class="sub-item row"
            >
              <div class="col-9">{{ product.name }}</div>
              <div class="col-2">R$ {{ product.price }}</div>
              <div class="col-1 add" @click="addToCart(category, product)">
                +
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="col-4">
        <h1>Shopping Cart</h1>
        <ul class="list-group">
          <li class="list-group-item" v-if="shoppingCart.length === 0">
            <small>
              Your shopping cart is empty :(
              <br />
              Click + on product list to add it here
            </small>
          </li>
          <li
            class="list-group-item"
            :key="item.id"
            v-for="(item, index) in shoppingCart"
          >
            <div class="row cart-item">
              <div class="col-8">
                <div class="short-div">{{ item.name }}</div>
                <div class="short-div">
                  R$ {{ item.price }}
                  <small style="opacity: 0.8"
                    >+ R$ {{ roundNumber(item.tax) }}</small
                  >
                </div>
              </div>
              <div class="col">
                <div class="quantity">
                  <span
                    class="quantity__button"
                    @click="updateQuantity('decrease', index)"
                    >-</span
                  >
                  {{ item.quantity }}
                  <span
                    class="quantity__button"
                    @click="updateQuantity('increase', index)"
                    >+</span
                  >
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item" v-if="shoppingCart.length">
            <span
              ><strong>SubTotal:</strong>
              <span class="float-right">R$ {{ subtotal }}</span></span
            >
            <br />
            <span
              ><strong>Tax Total:</strong>
              <span class="float-right">R$ {{ taxTotal }}</span></span
            >
            <br />
            <span
              ><strong>Total:</strong>
              <span class="float-right">R$ {{ total }}</span></span
            >
          </li>
          <li class="list-group-item" v-if="shoppingCart.length">
            <span class="save-button" @click="saveOrder()">Save</span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
import ProductCategoryService from "../services/ProductCategory";
import OrderService from "../services/Order";

export default {
  name: "OrderCreator",
  components: {},
  setup() {
    return {};
  },
  data() {
    return {
      categories: [],
      shoppingCart: [],
      subtotal: 0,
      taxTotal: 0,
      total: 0,
    };
  },
  async mounted() {
    const productCategoryService = new ProductCategoryService();
    const categories = await productCategoryService.getCategories();
    this.categories = categories.filter((category) => {
      if (category.products.length > 0) return true;
    });
  },
  methods: {
    addToCart(category, product) {
      const index = this.shoppingCart.findIndex((cartItem) => {
        return cartItem.id === product.id;
      });

      let item = product;

      if (index != -1) {
        this.shoppingCart[index].quantity++;
        this.updateTotals();
        return;
      }

      item.quantity = 1;
      item.tax = product.price * (category.tax / 100);
      this.shoppingCart.push(item);

      this.updateTotals();
    },
    updateQuantity(alow, itemIndex) {
      if (alow === "increase") {
        this.shoppingCart[itemIndex].quantity++;
        this.updateTotals();
        return;
      }

      this.shoppingCart[itemIndex].quantity--;
      this.updateTotals();
      if (this.shoppingCart[itemIndex].quantity <= 0)
        this.shoppingCart.splice(itemIndex, 1);
    },
    updateTotals() {
      this.subtotal = 0;
      this.taxTotal = 0;
      this.total = 0;

      this.shoppingCart.forEach((item) => {
        this.subtotal += this.roundNumber(Number(item.price) * item.quantity);
        this.taxTotal += this.roundNumber(Number(item.tax) * item.quantity);
      });

      this.total = this.roundNumber(this.subtotal + this.taxTotal);
    },
    roundNumber(number) {
      return Math.round((number + Number.EPSILON) * 100) / 100;
    },
    async saveOrder() {
      console.log(this.shoppingCart);
      const orderService = new OrderService();
      const createdOrder = await orderService.createOrder(this.shoppingCart);
      this.$router.push({
        name: "OrderList",
        params: { receivedNewOrder: createdOrder.id },
      });
    },
  },
};
</script>

<style lang="scss" scoped>
.list-group-item {
  cursor: default;
  background-color: rgba(255, 127, 80, 0.204);

  &:hover {
    color: #212529;
  }

  &:first-child {
    border-radius: 10px 10px 0 0;
  }

  &:last-child {
    border-radius: 0 0 10px 10px;
  }

  &:only-child {
    border-radius: 10px;
  }

  & .item-title {
    font-size: 30px;
    margin-bottom: 10px;
  }

  & .sub-item {
    font-size: 20px;
    padding-left: 10px;
    display: flex;
    align-items: center;
    transition: all ease 0.1s;

    &:not(:last-child) {
      border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }

    &:hover {
      background-color: rgba(255, 127, 80, 0.226);
    }

    & .add {
      font-size: 30px;
      cursor: pointer;
    }
  }
}

.cart-item {
  line-height: 1.2;
  display: flex;
  align-items: center;
}

.quantity {
  font-size: 22px;
  float: right;

  &__button {
    cursor: pointer;
  }
}

.save-button {
  float: right;
  // margin-top: 5px;
  cursor: pointer;
  text-transform: uppercase;
  letter-spacing: 0.2em;
  font-weight: 800;
  color: #56504a;

  &:hover {
    color: rgb(172, 85, 53);
  }
}
</style>
