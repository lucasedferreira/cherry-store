<template>
  <div>
    <div id="header">
      <img
        class="logoHeader"
        :src="image"
        @click="navigateTo('Home')"
        style="width: 150px"
      />
      <nav>
        <ul>
          <li @click="navigateTo('Home')">Home</li>
          <li @click="navigateTo('ProductCategory')">Product Categories</li>
          <li @click="navigateTo('Order')">Orders</li>
          <li @click="navigateTo('NewOrder')">Make a Order</li>
        </ul>
      </nav>
      <div id="icons">github</div>
    </div>
  </div>
</template>

<script>
import image from "../assets/logo-small.png";
export default {
  name: "MainHeader",
  data() {
    return {
      image,
    };
  },
  methods: {
    navigateTo(route) {
      this.$router.push({ name: route });
    },
  },
};
</script>

<style>
#header {
  width: 100%;
  height: 70px;
  display: flex;
  align-items: center;
  background: linear-gradient(to bottom, #727877 0%, #c0c0b808 100%);
}
.logoHeader {
  margin-left: 30px;
}
.logoHeader:hover {
  cursor: pointer;
}
nav {
  width: 70vw;
  color: #141714;
  display: flex;
  align-items: center;
}
ul {
  list-style: none;
  margin: 0;
  padding-left: 30px;
}
li {
  display: block;
  float: left;
  padding: 1rem;
  position: relative;
  text-decoration: none;
  transition-duration: 0.5s;
  font-family: Kanit, Haettenschweiler, "Arial Narrow Bold", sans-serif;
  font-size: 16px;
}
li a {
  color: #fff;
  cursor: default;
}
li:hover {
  cursor: pointer;
  color: #56504a;
}
#icons {
  width: 10%;
  display: flex;
  justify-content: space-around;
  align-items: center;
}
</style>
