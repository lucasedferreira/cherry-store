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

<style lang="scss">
* {
  font-family: Kanit, Haettenschweiler, "Arial Narrow Bold", sans-serif;
  margin: 0;
  padding: 0;
  outline: 0;
  box-sizing: border-box;
}

html {
  min-height: 100%;
}

body {
  background: linear-gradient(coral, transparent),
    linear-gradient(90deg, coral, transparent),
    linear-gradient(45deg, skyblue, transparent),
    linear-gradient(-90deg, limegreen, transparent) !important;
  background-blend-mode: screen;
}

.container {
  margin-top: 50px;
}

.table {
  background-color: #fff;
  box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}

thead {
  background-color: #dea2094d;
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
</style>
