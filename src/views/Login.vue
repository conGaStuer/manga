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
import { ref } from "vue";
export default {
  setup() {
    const username = ref("");
    const password = ref("");
    const errorMessage = ref("");
    const login = () => {
      axios
        .post("http://localhost/manga/manga/src/api/login.php", {
          username: username.value,
          password: password.value,
        })
        .then((response) => {
          if (response.data.message === "Login successful") {
            console.log("Login successful");
            // Điều hướng đến trang chính hoặc thực hiện hành động tiếp theo tại đây
          } else {
            errorMessage.value = "Invalid username or password";
          }
        })
        .catch((error) => {
          console.log("An error occurred", error);
        });
    };
    return { username, password, login, errorMessage };
  },
};
</script>

<style></style>
