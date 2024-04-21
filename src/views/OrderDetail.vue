<template>
  <NavBar></NavBar>
  <div class="orders">
    <span>Orders</span>
    <table border="1">
      <tr>
        <th></th>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Order_status</th>
      </tr>
      <tr v-for="ordersItem in orders" :key="ordersItem.id" class="tr">
        <th class="th">
          <router-link
            :to="`./mangas/${ordersItem.manga_id}`"
            :style="{ backgroundImage: `url(${ordersItem.hinhanh})` }"
            class="image"
          ></router-link>
        </th>
        <th>{{ ordersItem.name }}</th>
        <th>$ {{ ordersItem.price }}.00</th>
        <th>
          {{ ordersItem.quantity }}
        </th>
        <th>
          {{ ordersItem.order_status }}
        </th>
      </tr>
      <tr>
        <th class="totall">TOTAL: $ {{ total }}.00</th>
      </tr>
    </table>
  </div>
  <Box></Box>
  <Footer></Footer>
</template>

<script>
import NavBar from "./NavBar.vue";
import Box from "./Box.vue";
import Footer from "./Footer.vue";
import axios from "axios";
import { onMounted, ref } from "vue";
export default {
  components: {
    NavBar,
    Box,
    Footer,
  },
  setup() {
    const orders = ref();
    onMounted(() => {
      axios
        .get("http://localhost/manga/manga/src/api/order_detail.php")
        .then((res) => {
          if (res.data) {
            orders.value = res.data;
          } else {
            console.log("Error when get");
          }
        })
        .catch((err) => {
          console.log("Error", err);
        });
      getTotal();
    });
    const total = ref("");
    const getTotal = () => {
      axios
        .get("http://localhost/manga/manga/src/api/total.php")
        .then((res) => {
          total.value = res.data;
          console.log(cart.value);
        })
        .catch((err) => {
          console.log("Error", err);
        });
    };
    return {
      orders,
      total,
    };
  },
};
</script>

<style>
@import url(../style/order_detail.scss);
</style>
