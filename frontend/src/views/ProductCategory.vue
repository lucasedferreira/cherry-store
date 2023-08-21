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
        <tr :key="category.id" v-for="category in categories">
          <td>
            {{ category.name }}
          </td>
          <td>{{ category.tax }}%</td>
          <td style="width: 18%">
            <a class="action-button" @click="open(category)">
              <img :src="openIcon" width="20" alt="open" />
            </a>
            <a class="action-button" @click="delete category.id">
              <img :src="deleteIcon" width="20" alt="delete" />
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
            <div class="form-group form-control-sm">
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
import addIcon from "@/assets/icons/add.svg";
import ProductCategoryService from "../services/ProductCategory";

export default {
  name: "ProductCategory",
  components: {},
  setup() {
    return {
      openIcon,
      deleteIcon,
      addIcon,
    };
  },
  data() {
    return {
      categories: [],
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
      showLoading: true,
    };
  },
  async mounted() {
    const productCategoryService = new ProductCategoryService();
    this.categories = await productCategoryService.getCategories();
  },
  methods: {
    async add() {
      if (!this.validate()) return;

      const productCategoryService = new ProductCategoryService();
      await productCategoryService.addCategory({
        name: this.input.name.value,
        tax: this.input.tax.value,
      });

      this.categories = await productCategoryService.getCategories();
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
  },
};
</script>

<style lang="scss" scoped>
.container {
  margin-top: 50px;
}

.table {
  background-color: #fff;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}

thead {
  // background-color: #09de3764;
  background-color: #dea10964;
}

tbody tr:not(:last-child):hover {
  background-color: #dea2090f;
}

.action-button {
  cursor: pointer;
  margin-right: 10px;
}

.add-button {
  cursor: pointer;
  position: relative;

  img {
    position: absolute;
    top: 50%;
    left: 35px;
    transform: translate(-50%, -50%);
  }
}

.form-control-sm {
  height: calc(1.5em + 4rem + 2px);
}
</style>
