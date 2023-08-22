import { createWebHistory, createRouter } from "vue-router";
import HomePage from "./views/HomePage";
import AboutMe from "./views/AboutMe";
import ProductCategory from "./views/ProductCategory";
import CategoryProducts from "./views/CategoryProducts";
import OrderList from "./views/OrderList";
import OrderProducts from "./views/OrderProducts";
import OrderCreator from "./views/OrderCreator";

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
  {
    path: "/product-category/:categoryID/products",
    name: "CategoryProducts",
    component: CategoryProducts,
  },
  {
    path: "/order",
    name: "OrderList",
    component: OrderList,
  },
  {
    path: "/order/products",
    name: "OrderProducts",
    component: OrderProducts,
  },
  {
    path: "/create-order",
    name: "MakeOrder",
    component: OrderCreator,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
