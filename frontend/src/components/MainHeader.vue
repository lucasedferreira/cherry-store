<template>
  <div>
    <div id="header">
      <img
        class="logoHeader"
        :src="image"
        @click="navigateTo('Home')"
        style="height: 50px"
      />
      <nav>
        <ul>
          <li @click="navigateTo('Home')">Home</li>
          <li @click="navigateTo('ProductCategory')">Product Categories</li>
          <li @click="navigateTo('Order')">Orders</li>
          <li @click="navigateTo('NewOrder')">Make a Order</li>
          <li><a href="https://github.com/lucasedferreira/cherry-store" target="_blank"><img :src="githubIcon" height="30" alt="github" /></a></li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
import image from "../assets/logo-small.png";
import githubIcon from "@/assets/icons/github.svg";

export default {
  name: "MainHeader",
  setup() {
    return {
      image,
      githubIcon,
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
  background: linear-gradient(to bottom, coral 0%, transparent 100%);
}
.logoHeader {
  margin-left: 30px;
}
.logoHeader:hover {
  cursor: pointer;
}
nav {
  width: 100%;
  color: #141714;
  display: flex;
  align-items: center;
}
ul {
  list-style: none;
  margin: 0;
  padding: 0 30px;
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
li:hover {
  cursor: pointer;
  color: #56504a;
}
li:last-child {
  float: right;
}
</style>
