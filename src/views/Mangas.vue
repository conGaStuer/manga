<template>
  <NavBar></NavBar>
  <div class="intro">
    <h1>Mangas</h1>
    <span>
      Naoki Urasawa's career as a manga artist spans more than twenty years and
      has firmly established him as one of the true manga masters of Japan. Born
      in Tokyo in 1960, Urasawa debuted with BETA! in 1983 and hasn't stopped
      his impressive output since.
    </span>
  </div>
  <div class="intro-manga">
    <div class="intro-text">
      <h4>NEW RELEASE</h4>
      <h2>20th of Century Boys</h2>
      <span>
        20th Century Boys won the Kodansha Manga Award in the general category
        in 2001, an Excellence Prize at the Japan Media Arts Festival in 2002,
        and the Shogakukan Manga Award in the general category in 2003. The
        series' combined storyline won the Grand Prize at the 37th Japan
        Cartoonist Awards on May 9, 2008.
      </span>
      <div>
        <button class="btn-1">Buy Now</button>
        <button class="btn-2">Read Sample</button>
      </div>
    </div>
    <div
      class="intro-image"
      :style="{
        backgroundImage: `url('https://i.pinimg.com/564x/da/7d/13/da7d13bf004111e3a2c6b1217520c54a.jpg')`,
      }"
    ></div>
  </div>
  <span class="more">More Mangas</span>
  <div class="mangaas">
    <router-link
      class="mangaa"
      v-for="manga in mangas"
      :key="manga.manga_id"
      :to="{ name: 'mangaDetail', params: { id: manga.manga_id } }"
    >
      <div
        class="mangaa-cover"
        :style="{ backgroundImage: `url(${manga.hinhanh})` }"
      ></div>
      <div class="mangaa-category">
        {{ manga.category }}
      </div>
      <div class="mangaa-name">
        {{ manga.name }}
      </div>
      <div class="mangaa-price">$ {{ manga.price }}</div>
    </router-link>
  </div>
  <Box></Box>
  <Footer></Footer>
</template>

<script>
import NavBar from "./NavBar.vue";
import Box from "./Box.vue";
import Footer from "./Footer.vue";
import axios from "axios";
import { ref, onMounted } from "vue";
import router from "@/router";
export default {
  components: { NavBar, Footer, Box },
  setup() {
    const mangas = ref();
    onMounted(() => {
      const get_manga = () => {
        axios
          .get("http://localhost/manga/manga/src/api/all_book.php")
          .then((res) => {
            mangas.value = res.data;
            console.log(mangas.value);
          })
          .catch((err) => {
            console.log("Error", err);
          });
      };
      get_manga();
    });

    return {
      mangas,
    };
  },
};
</script>

<style scoped>
@import url(../style/mangas.scss);
</style>
