<template>
  <div class="container">
    <h1>{{ category.name }}</h1>
    <table class="table" v-show="category">
      <thead>
        <tr>
          <th>Name</th>
          <th>Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr :key="product.id" v-for="(product, index) in category.products">
          <td v-show="edditing != product.id">{{ product.name }}</td>
          <td v-show="edditing != product.id">R$ {{ product.price }}</td>
          <td v-show="edditing == product.id">
            <input
              type="text"
              class="form-control form-control-sm"
              placeholder="Enter name"
              v-model="product.name"
            />
          </td>
          <td v-show="edditing == product.id">
            <input
              type="text"
              class="form-control form-control-sm"
              placeholder="Enter price"
              v-model="product.price"
            />
          </td>
          <td v-show="edditing != product.id" style="width: 18%">
            <a class="action-button" @click="deleteProduct(product.id, index)">
              <img :src="deleteIcon" width="20" alt="delete" />
            </a>
            <a class="action-button" @click="edditing = product.id">
              <img :src="editIcon" width="16" alt="edit" />
            </a>
          </td>
          <td v-show="edditing == product.id" style="width: 18%">
            <a class="action-button" @click="updateProduct(product)">
              <img :src="saveIcon" width="16" alt="edit" />
            </a>
          </td>
        </tr>
        <tr>
          <td>
            <div class="form-group form-control-sm">
              <label for="name">Name</label>
              <input
                type="text"
                class="form-control"
                id="name"
                placeholder="Enter name"
                v-model="input.name.value"
              />
              <small class="form-text text-danger" v-if="input.name.error"
                >Name is required</small
              >
            </div>
          </td>
          <td>
            <div class="form-group">
              <label for="price">Price (R$)</label>
              <input
                type="text"
                class="form-control"
                id="price"
                placeholder="Enter price"
                v-model="input.price.value"
              />
              <small class="form-text text-danger" v-if="input.price.error"
                >Price is required</small
              >
            </div>
          </td>
          <td class="add-button">
            <a href="#!" @click="add"
              ><img :src="addIcon" width="40" alt="delete"
            /></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import editIcon from "@/assets/icons/edit.svg";
import saveIcon from "@/assets/icons/save.svg";
import deleteIcon from "@/assets/icons/delete.svg";
import addIcon from "@/assets/icons/add.svg";
import ProductCategoryService from "../services/ProductCategory";
import ProductService from "../services/Product";

export default {
  name: "CategoryProducts",
  components: {},
  setup() {
    return {
      editIcon,
      saveIcon,
      deleteIcon,
      addIcon,
    };
  },
  data() {
    return {
      category: {},
      edditing: null,
      input: {
        name: {
          value: "",
          error: false,
        },
        price: {
          value: "",
          error: false,
        },
      },
    };
  },
  async mounted() {
    const productCategoryService = new ProductCategoryService();
    this.category = await productCategoryService.getByID(
      this.$route.params.categoryID
    );
  },
  methods: {
    async updateProduct(product) {
      const productService = new ProductService();
      await productService.updateProduct(product);
      this.edditing = null;
    },
    async add() {
      const productService = new ProductService();
      const createdProduct = await productService.addProduct({
        name: this.input.name.value,
        price: this.input.price.value,
        categoryID: this.category.id,
      });
      this.category.products.push(createdProduct);
    },
    validate() {
      if (this.input.name.value === "") this.input.name.error = true;
      if (this.input.price.value === "") this.input.price.error = true;
      if (this.input.name.error || this.input.price.error) return false;
      return true;
    },
    resetInputs() {
      this.input = {
        name: {
          value: "",
          error: false,
        },
        price: {
          value: "",
          error: false,
        },
      };
    },
    async deleteProduct(productID, productIndex) {
      const productService = new ProductService();
      await productService.deleteProduct(productID);
      this.category.products.splice(productIndex, 1);
    },
  },
};
</script>
