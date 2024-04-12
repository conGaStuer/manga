<template>
  {{ user }}
</template>

<script>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";

export default {
  setup() {
    const route = useRoute();
    const user_id = ref(null);
    const user = ref();
    const getUser = () => {
      axios
        .post(`http://localhost/manga/manga/src/api/user.php`, {
          userId: user_id.value,
        })
        .then((res) => {
          user.value = res.data;
          console.log(user.value);
        })
        .catch((err) => {
          console.log("Error", err);
        });
    };
    // Lấy dữ liệu user từ route.params khi component được mount
    onMounted(() => {
      if (route.query.user) {
        user_id.value = route.query.user;
        console.log(user_id.value);
      }
      getUser();
    });

    return { user_id, user };
  },
};
</script>

<style>
/* CSS của bạn */
</style>
