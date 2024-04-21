<template>
  <form @submit.prevent="login">
    <div v-if="errorMessage" style="color: red">{{ errorMessage }}</div>

    <input type="text" placeholder="Username" v-model="username" />
    <input type="password" placeholder="Password" v-model="password" />
    <button type="submit">Login</button>
  </form>
</template>

<script>
import axios from "axios";
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";
export default {
  setup() {
    const username = ref("");
    const password = ref("");
    const errorMessage = ref("");
    const user = ref([]);

    const login = () => {
      axios
        .post("http://localhost/manga/manga/src/api/login.php", {
          username: username.value,
          password: password.value,
        })
        .then((response) => {
          user.value = response.data;
          window.location.href = "/";
        })
        .catch((error) => {
          console.error(error);
        });
    };

    return { username, password, login, errorMessage, user };
  },
};
</script>
