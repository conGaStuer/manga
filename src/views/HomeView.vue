<template>
  <nav-bar></nav-bar>
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
  <div class="intro-author">
    <div
      class="intro-author--image"
      :style="{
        backgroundImage: `url('https://i.pinimg.com/564x/7f/96/96/7f9696f59998d5c8125ca16911a13b23.jpg')`,
      }"
    ></div>
    <div class="intro-author--text intro-text">
      <h4>BIOGRAPHY</h4>
      <h2>Naoki Urasawa</h2>
      <span>
        Naoki Urasawa's career as a manga artist spans more than twenty years
        and has firmly established him as one of the true manga masters of
        Japan. Born in Tokyo in 1960, Urasawa debuted with BETA! in 1983 and
        hasn't stopped his impressive output since.
        <br />
        <br />
        No stranger to accolades and awards, Urasawa is a three-time recipient
        of the prestigious Shogakukan Manga Award, a two-time recipient of the
        Osamu Tezuka Cultural Prize, and has received the Kodansha Manga Award.
        Similarly, Monster has been nominated twice for the Eisner Award in
        America.
      </span>
      <div>
        <button class="btn-2">Read More</button>
      </div>
    </div>
  </div>
  <div class="awards">
    <div class="award">
      <div
        class="award-logo"
        :style="{
          backgroundImage: `url('https://websitedemos.net/manga-store-02/wp-content/uploads/sites/834/2021/04/author-manga-store-awards-logo-1.svg')`,
        }"
      ></div>
      <h4>Shogakukan Manga Award 2000</h4>
      <span>
        The Shogakukan Manga Award (小学館漫画賞, Shōgakukan Mangashō) is one of
        Japan's major manga awards, and is sponsored by Shogakukan Publishing.
      </span>
    </div>
    <div class="award">
      <div
        class="award-logo"
        :style="{
          backgroundImage: `url('https://websitedemos.net/manga-store-02/wp-content/uploads/sites/834/2021/04/author-manga-store-awards-logo-.svg')`,
        }"
      ></div>
      <h4>Shogakukan Manga Award 2002</h4>
      <span>
        The Shogakukan Manga Award (小学館漫画賞, Shōgakukan Mangashō) is one of
        Japan's major manga awards, and is sponsored by Shogakukan Publishing.
      </span>
    </div>
    <div class="award">
      <div
        class="award-logo"
        :style="{
          backgroundImage: `url('https://websitedemos.net/manga-store-02/wp-content/uploads/sites/834/2021/04/author-manga-store-awards-logo-3.svg')`,
        }"
      ></div>
      <h4>Tezuka Osamu Cultural Prize 1999</h4>
      <span>
        Named after Osamu Tezuka, the Tezuka Osamu Cultural Prize
        (手塚治虫文化賞, Tezuka Osamu Bunkashō) is a yearly manga prize awarded
        to manga artists
      </span>
    </div>
    <div class="award">
      <div
        class="award-logo"
        :style="{
          backgroundImage: `url('https://websitedemos.net/manga-store-02/wp-content/uploads/sites/834/2021/04/author-manga-store-awards-logo-4.svg')`,
        }"
      ></div>
      <h4>Tezuka Osamu Cultural Prize 2005</h4>
      <span>
        Named after Osamu Tezuka, the Tezuka Osamu Cultural Prize
        (手塚治虫文化賞, Tezuka Osamu Bunkashō) is a yearly manga prize awarded
        to manga artists
      </span>
    </div>
  </div>
  <div class="mangas">
    <h2>Best Selling Mangas</h2>
    <span
      >Many of his mangas have spawned popular animated and live-action TV
      programs and films, and 2008 saw the theatrical release of the first of
      three live-action Japanese films based on 20th Century Boys.</span
    >
    <div class="intro-manga">
      <div class="manga" v-for="manga in mangas" :key="manga.id">
        <div
          class="manga-cover"
          :style="{ backgroundImage: `url(${manga.hinhanh})` }"
        ></div>
        <div class="manga-category">
          {{ manga.category }}
        </div>
        <div class="manga-name">
          {{ manga.name }}
        </div>
        <div class="manga-price">$ {{ manga.price }}</div>
      </div>
    </div>
  </div>
  <div class="shop-all">
    <button>Shop All Manga</button>
  </div>
  <div class="video-background">
    <div class="video-foreground">
      <iframe
        src="https://www.youtube.com/embed/HCwDMA_ZJX0?autoplay=1"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin"
        allowfullscreen
      ></iframe>
    </div>
  </div>
  <Box></Box>
  <Footer></Footer>
</template>

<script>
// @ is an alias to /src
import axios from "axios";
import { ref, onMounted } from "vue";
import NavBar from "./NavBar.vue";
import Footer from "./Footer.vue";
import Box from "./Box.vue";
export default {
  name: "HomeView",
  components: { NavBar, Footer, Box },
  setup() {
    const mangas = ref();
    onMounted(() => {
      const get_manga = () => {
        axios
          .get("http://localhost/manga/manga/src/api/random_boook.php")
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
@import url("../style/home.scss");
</style>
