<template>
  <div class="container text-center">
    <h1>{{ category.name }}</h1>
    <LoadingSpinner v-if="loading" style="margin-top: 15px" />
    <table class="table text-left" v-if="!loading">
      <thead>
        <tr>
          <th>Name</th>
          <th>Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <th
          colspan="3"
          class="text-center"
          v-show="!category.products || !category.products.length"
        >
          Bah, please add some products 🙏
        </th>
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
                v-maska
                data-maska="0.99"
                data-maska-tokens="0:\d:multiple|9:\d:optional"
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
    <vue3-confirm-dialog></vue3-confirm-dialog>
  </div>
</template>

<script>
import LoadingSpinner from "@/components/LoadingSpinner.vue";
import editIcon from "@/assets/icons/edit.svg";
import saveIcon from "@/assets/icons/save.svg";
import deleteIcon from "@/assets/icons/delete.svg";
import addIcon from "@/assets/icons/add.svg";
import ProductCategoryService from "../services/ProductCategory";
import ProductService from "../services/Product";
import { vMaska } from "maska";
import { toast } from "vue3-toastify";

export default {
  name: "CategoryProducts",
  components: { LoadingSpinner },
  directives: { maska: vMaska },
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
      loading: true,
    };
  },
  async mounted() {
    const productCategoryService = new ProductCategoryService();
    this.category = await productCategoryService.getByID(
      this.$route.params.categoryID
    );
    this.loading = false;
  },
  methods: {
    async updateProduct(product) {
      const productService = new ProductService();
      await productService.updateProduct(product);
      this.edditing = null;
    },
    async add() {
      if (!this.validate()) return;

      const productService = new ProductService();
      const createdProduct = await productService.addProduct({
        name: this.input.name.value,
        price: this.input.price.value,
        categoryID: this.category.id,
      });
      this.category.products.push(createdProduct);
      this.resetInputs();
    },
    validate() {
      if (!this.input.name.value) this.input.name.error = true;
      else this.input.name.error = false;

      if (!this.input.price.value) this.input.price.error = true;
      else this.input.price.error = false;

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
      this.$confirm({
        message: "Are you sure?",
        button: {
          no: "No",
          yes: "Yes",
        },
        callback: async (confirm) => {
          if (confirm) {
            const productService = new ProductService();
            await productService.deleteProduct(productID);
            this.category.products.splice(productIndex, 1);

            toast("Product deleted.", {
              autoClose: 3000,
              type: "success",
              transition: "slide",
            });
          }
        },
      });
    },
  },
};
</script>
