<template>
  <router-view />
  <User></User>
</template>
<script>
import User from "./views/User.vue";
export default {
  components: {
    User,
  },
};
</script>
<style lang="scss">
#app {
  font-family: "EB Garamond", serif;
  padding: 0;
  margin: 0;
  color: #565a61;
}
// nav {
//   padding: 30px;

//   a {
//     font-weight: bold;
//     color: #2c3e50;

//     &.router-link-exact-active {
//       color: #42b983;
//     }
//   }
// }
</style>
