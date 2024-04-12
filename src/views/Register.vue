<template>
  <form @submit.prevent="register">
    <div v-if="errorMessage" style="color: red">{{ errorMessage }}</div>
    <input v-model="username" placeholder="Username" type="text" />
    <input v-model="password" placeholder="Password" type="password" />
    <button type="submit">Register</button>
  </form>
</template>

<script>
import axios from "axios";
import { onMounted, ref } from "vue";
export default {
  setup() {
    const username = ref("");
    const password = ref("");
    const errorMessage = ref("");
    const register = () => {
      axios
        .post("http://localhost/manga/manga/src/api/register.php", {
          username: username.value,
          password: password.value,
        })
        .then((response) => {
          if (response.data.message === "Registration successful") {
            // window.location.href = "/";
            console.log("thanh cong");
          } else {
            errorMessage.value = "Username already exists";
          }
        })
        .catch((error) => {
          console.error("There was an error!", error);
        });
    };
    return {
      username,
      password,
      register,
      errorMessage,
    };
  },
};
</script>

<style></style>
