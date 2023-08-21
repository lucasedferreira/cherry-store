<template>
  <div class="container">
    <h1>Product Categories</h1>
    <table class="table table-hover" v-show="categories.length">
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
                v-model="input.name"
              />
              <small class="form-text text-danger"
                >We'll never share your email with anyone else.</small
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
                v-model="input.tax"
              />
              <small class="form-text text-danger"
                >We'll never share your email with anyone else.</small
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
import { Categories } from "../services/ProductCategory";

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
        name: "",
        tax: "",
      },
      showLoading: true,
    };
  },
  async mounted() {
    this.categories = await Categories();
  },
};
</script>

<style lang="scss" scoped>
.table {
  background-color: #fff;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
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
