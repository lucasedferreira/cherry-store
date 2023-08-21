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
.body {
  background: linear-gradient(limegreen, transparent),
    linear-gradient(90deg, skyblue, transparent),
    linear-gradient(-90deg, coral, transparent);
  background-blend-mode: screen;
  height: 100vh;
}
</style>
