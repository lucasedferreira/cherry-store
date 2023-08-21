<template>
  <div class="welcome">
    <strong class="welcome__title">Welcome!</strong>
    <p class="welcome__content">
      Select the page you want to go in the navbar ;)
    </p>
  </div>
</template>

<script>
export default {
  name: "HomePage",
  components: {},
};
</script>

<style lang="scss" scoped>
.welcome {
  position: absolute;
  top: 45%;
  left: 50%;
  -webkit-transform: translateX(-50%);
  transform: translateX(-50%);
  text-align: center;

  color: #141714;
  &__title {
    font-size: 50px;
  }
  &__content {
    font-size: 30px;
  }
}
</style>
