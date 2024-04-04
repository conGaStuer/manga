<template>
  <div>
    <h1>{{ manga.name }}</h1>
    <div>{{ manga.description }}</div>
    <div>{{ manga.category }}</div>
    <div>{{ manga.price }}</div>
    <!-- Các thông tin khác cần hiển thị -->
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRoute } from "vue-router";

export default {
  setup() {
    const manga = ref({});
    const route = useRoute();

    const getMangaDetail = () => {
      const mangaId = route.params.id;
      axios
        .get(
          `http://localhost/manga/manga/src/api/manga_detail.php?id=${mangaId}`
        )
        .then((response) => {
          manga.value = response.data;
        })
        .catch((error) => {
          console.error("There was an error!", error);
        });
    };

    onMounted(() => {
      getMangaDetail();
    });

    return {
      manga,
    };
  },
};
</script>

<style scoped>
/* Các quy tắc CSS cho trang chi tiết manga */
</style>
