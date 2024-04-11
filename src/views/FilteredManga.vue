<template>
  <NavBar></NavBar>
  <div class="query-mangas">
    <div class="query-side">
      <div class="search">
        <input type="text" placeholder="Search...." />
        <button>></button>
      </div>
      <div class="price">
        <h3>Filter by price</h3>
        <input
          type="range"
          min="0"
          max="100"
          v-model="priceRange"
          @input="filterMangaByPrice"
          class="slider"
        />
        <p>Price Range: ${{ priceRange }}</p>
      </div>
    </div>
    <div class="manga-side">
      <div class="link"><router-link to="/">Home</router-link> / {{ tag }}</div>
      <h1>{{ tag }}</h1>
      <div class="show">
        <span>Showing all ... results</span>
        <span>Sorting</span>
      </div>
      <div class="mangas-grid">
        <router-link
          :to="`/mangas/${manga.manga_id}`"
          v-for="manga in filteredMangas"
          :key="manga.manga_id"
          class="manga-info"
        >
          <div
            class="manga-image"
            :style="{ backgroundImage: `url(${manga.hinhanh})` }"
          ></div>
          <div class="manga-tag">{{ manga.tags }}</div>
          <div class="manga-name">{{ manga.name }}</div>
          <div class="manga-price">$ {{ manga.price }}.00</div>
        </router-link>
      </div>
    </div>
  </div>
  <Box></Box>
  <Footer></Footer>
</template>

<script>
import { ref, onMounted } from "vue";
import axios from "axios";
import { useRoute } from "vue-router";
import NavBar from "./NavBar.vue";
import Footer from "./Footer.vue";
import Box from "./Box.vue";

export default {
  components: { NavBar, Box, Footer },

  setup() {
    const tag = ref("");
    const filteredMangas = ref([]);
    const route = useRoute();
    const priceRange = ref(50);
    const allMangas = ref([]);
    const filterMangaByTag = () => {
      axios
        .post("http://localhost/manga/manga/src/api/manga_tag.php", {
          mangaTag: tag.value,
        })
        .then((res) => {
          if (res.data) {
            filteredMangas.value = res.data;
            console.log(filteredMangas.value);
          } else {
            console.log("error");
          }
        })
        .catch((err) => {
          console.log("Error", err);
        });
    };
    const filterMangaByPrice = () => {
      filteredMangas.value = allMangas.value.filter((manga) => {
        return manga.price >= 0 && manga.price <= priceRange.value;
      });
    };
    onMounted(() => {
      axios
        .get("http://localhost/manga/manga/src/api/all_book.php")
        .then((response) => {
          allMangas.value = response.data;
          filterMangaByTag(); // Sau khi nhận được danh sách manga, lọc dựa trên tag
        })
        .catch((error) => {
          console.error("Error fetching manga data: ", error);
        });
      tag.value = route.query.tag;
      filterMangaByTag();
    });

    return {
      filteredMangas,
      tag,
      priceRange,
      allMangas,
      filterMangaByPrice,
    };
  },
};
</script>

<style scoped>
/* CSS styles */
@import url(../style/filter_manga.scss);
</style>
