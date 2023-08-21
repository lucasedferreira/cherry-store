<template>
  <div class="body">
    <div id="app"></div>
    <MainHeader />
    <router-view />
  </div>
</template>

<script>
import MainHeader from "./components/MainHeader";
export default {
  name: "App",
  components: {
    MainHeader,
  },
};
</script>

<style>
* {
  font-family: Kanit, Haettenschweiler, "Arial Narrow Bold", sans-serif;
  margin: 0;
  padding: 0;
  outline: 0;
  box-sizing: border-box;
}
body {
  background: linear-gradient(coral, transparent),
    linear-gradient(90deg, coral, transparent),
    linear-gradient(45deg, skyblue, transparent),
    linear-gradient(-90deg, limegreen, transparent) !important;
  background-blend-mode: screen;
}
</style>
