import { createWebHistory, createRouter } from "vue-router";
import HomePage from "./views/HomePage";
import AboutMe from "./views/AboutMe";
import ProductCategory from "./views/ProductCategory";

const routes = [
  {
    path: "/",
    name: "Home",
    component: HomePage,
  },
  {
    path: "/about",
    name: "About",
    component: AboutMe,
  },
  {
    path: "/product-category",
    name: "ProductCategory",
    component: ProductCategory,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;