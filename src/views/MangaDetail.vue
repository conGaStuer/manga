<template>
  <NavBar></NavBar>
  <div class="manga">
    <div class="manga-side">
      <div
        class="manga-image"
        :style="{ backgroundImage: `url(${manga.hinhanh})` }"
      ></div>
      <div class="manga-info">
        <div class="manga-link">
          <router-link to="/">Home</router-link> / {{ manga.category }} /
          {{ manga.name }}
        </div>
        <h5>{{ manga.category }}</h5>
        <div class="manga-name">{{ manga.name }}</div>
        <div class="price">
          <span class="manga-price">$ {{ manga.price }}</span>
          <span>+ Free Shipping</span>
        </div>
        <span class="manga-short-des">
          {{ manga.short_des }}
        </span>
        <button @click="addToCart">Add to cart</button>
        <span v-if="showAdd" class="show">Added to cart successful!!</span>
        <div class="line"></div>
        <div class="tags">
          Category : <span>{{ manga.category }} </span> Tags:<span>
            {{ manga.tags }}
          </span>
        </div>
      </div>
    </div>
  </div>
  <div class="des">
    <h4>Description</h4>
    <span>
      {{ manga.description }}
    </span>
  </div>
  <div class="related">
    <h4>Related Manga</h4>
    <div class="relate">
      <div
        v-for="relate_manga in relate_mangas"
        :key="relate_manga.manga_id"
        class="relate-manga"
      >
        <div
          :style="{ backgroundImage: `url(${relate_manga.hinhanh})` }"
          class="relate-image"
        ></div>
        <div class="relate-cate">{{ relate_manga.category }}</div>
        <div class="relate-name">{{ relate_manga.name }}</div>
        <div class="relate-price">$ {{ relate_manga.price }}.00</div>
      </div>
    </div>
  </div>
  <Box></Box>
  <Footer> </Footer>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRoute, useRouter } from "vue-router";
import NavBar from "./NavBar.vue";
import Box from "./Box.vue";
import Footer from "./Footer.vue";
export default {
  components: {
    NavBar,
    Box,
    Footer,
  },
  setup() {
    const manga = ref({});
    const route = useRoute();
    const relate_mangas = ref({});
    const showAdd = ref(false);
    const addToCart = () => {
      showAdd.value = true;
      const cartItem = {
        manga_id: route.params.id,
        name: manga.value.name,
        price: manga.value.price,
        hinhanh: manga.value.hinhanh,
      };
      axios
        .post("http://localhost/manga/manga/src/api/addtocart.php", cartItem)
        .then((res) => {
          console.log("Manga added to cart: ", res.data);
        })
        .catch((err) => {
          console.log("Error ", err);
        });
    };
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
    const getRelatedManga = () => {
      axios
        .get("http://localhost/manga/manga/src/api/related-book.php")
        .then((res) => {
          relate_mangas.value = res.data;
        })
        .catch((err) => {
          console.log("error", err);
        });
    };

    onMounted(() => {
      getMangaDetail();
      getRelatedManga();
    });

    return {
      manga,
      relate_mangas,
      addToCart,
      showAdd,
    };
  },
};
</script>

<style scoped>
@import url(../style/manga_detail.scss);
/* Các quy tắc CSS cho trang chi tiết manga */
</style>
