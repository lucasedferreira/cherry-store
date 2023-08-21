<template>
  <div class="container">
    <h1>Product Categories</h1>
    <table class="table" v-show="categories.length">
      <thead>
        <tr>
          <th>Name</th>
          <th>Tax</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr :key="category.id" v-for="(category, index) in categories">
          <td v-show="edditing != category.id">{{ category.name }}</td>
          <td v-show="edditing != category.id">{{ category.tax }}%</td>
          <td v-show="edditing == category.id">
            <input
              type="text"
              class="form-control form-control-sm"
              placeholder="Enter name"
              v-model="category.name"
            />
          </td>
          <td v-show="edditing == category.id">
            <input
              type="text"
              class="form-control form-control-sm"
              placeholder="Enter tax"
              v-model="category.tax"
            />
          </td>
          <td v-show="edditing != category.id" style="width: 18%">
            <a class="action-button" @click="open(category.id)">
              <img :src="openIcon" width="20" alt="open" />
            </a>
            <a class="action-button" @click="edit(category.id)">
              <img :src="editIcon" width="16" alt="edit" />
            </a>
            <a
              class="action-button"
              @click="deleteCategory(category.id, index)"
            >
              <img :src="deleteIcon" width="20" alt="delete" />
            </a>
          </td>
          <td style="width: 18%" v-show="edditing == category.id">
            <a class="action-button" @click="updateCategory(category)">
              <img :src="saveIcon" width="20" alt="delete" />
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
              <label for="tax">Tax (%)</label>
              <input
                type="text"
                class="form-control"
                id="tax"
                placeholder="Enter tax"
                v-model="input.tax.value"
              />
              <small class="form-text text-danger" v-if="input.tax.error"
                >Tax is required</small
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
import openIcon from "@/assets/icons/open.svg";
import deleteIcon from "@/assets/icons/delete.svg";
import editIcon from "@/assets/icons/edit.svg";
import saveIcon from "@/assets/icons/save.svg";
import addIcon from "@/assets/icons/add.svg";
import ProductCategoryService from "../services/ProductCategory";

export default {
  name: "ProductCategory",
  components: {},
  setup() {
    return {
      openIcon,
      deleteIcon,
      editIcon,
      saveIcon,
      addIcon,
    };
  },
  data() {
    return {
      categories: [],
      edditing: null,
      input: {
        name: {
          value: "",
          error: false,
        },
        tax: {
          value: "",
          error: false,
        },
      },
    };
  },
  async mounted() {
    const productCategoryService = new ProductCategoryService();
    this.categories = await productCategoryService.getCategories();
  },
  methods: {
    edit(categoryID) {
      this.edditing = categoryID;
    },
    async add() {
      if (!this.validate()) return;

      const productCategoryService = new ProductCategoryService();
      const createdCategory = await productCategoryService.addCategory({
        name: this.input.name.value,
        tax: this.input.tax.value,
      });
      this.categories.push(createdCategory);

      this.resetInputs();
    },
    validate() {
      if (this.input.name.value === "") this.input.name.error = true;
      if (this.input.tax.value === "") this.input.tax.error = true;
      if (this.input.name.error || this.input.tax.error) return false;
      return true;
    },
    resetInputs() {
      this.input = {
        name: {
          value: "",
          error: false,
        },
        tax: {
          value: "",
          error: false,
        },
      };
    },
    open(categoryID) {
      this.$router.push({ path: `/product-category/${categoryID}/products` });
    },
    async updateCategory(category) {
      const productCategoryService = new ProductCategoryService();
      await productCategoryService.updateCategory(category);
      this.edditing = null;
    },
    async deleteCategory(categoryID, categoryIndex) {
      const productCategoryService = new ProductCategoryService();
      await productCategoryService.deleteCategory(categoryID);
      this.categories.splice(categoryIndex, 1);
    },
  },
};
</script>

<style lang="scss" scoped></style>
