<template>
  <NavBar></NavBar>
  <div class="cart-sides">
    <div class="cart">
      <span>Cart</span>
      <table border="1">
        <tr>
          <th></th>
          <th>Product</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Subtotal</th>
        </tr>
        <tr v-for="cartItem in cart" :key="cartItem.id" class="tr">
          <th class="th">
            <i
              class="fa-regular fa-circle-xmark"
              @click="deleteCart(cartItem)"
            ></i>
            <router-link
              :to="`./mangas/${cartItem.manga_id}`"
              :style="{ backgroundImage: `url(${cartItem.hinhanh})` }"
              class="image"
            ></router-link>
          </th>
          <th>{{ cartItem.name }}</th>
          <th>$ {{ cartItem.price }}.00</th>
          <th>
            <input
              type="number"
              v-model="cartItem.quantity"
              min="1"
              @change="updateQuantity(cartItem)"
              class="quantity"
            />
          </th>
          <th>$ {{ cartItem.subtotal }}.00</th>
        </tr>
        <tr class="coupon">
          <td colspan="5">
            <input type="text" placeholder="Coupon Code" />
            <button>Apply Coupon</button>
            <button class="update" @click="updateCart">Update Cart</button>
          </td>
        </tr>
      </table>
    </div>
  </div>
  <div class="total">
    <table border="1">
      <tr>
        <span>Cart Totals</span>
      </tr>
      <tr>
        <span>Subtotal </span>
        <span class="pric">$ {{ total }}.00</span>
      </tr>
      <tr>
        <span>Total </span>
        <span class="pri">$ {{ total }}.00</span>
      </tr>
      <tr>
        <router-link to="/order">
          <button>Proceed to checkout</button></router-link
        >
      </tr>
    </table>
  </div>
  <Box></Box>
  <Footer></Footer>
</template>

<script>
import NavBar from "./NavBar.vue";
import Footer from "./Footer.vue";
import Box from "./Box.vue";
import { onMounted, ref, computed } from "vue";
import axios from "axios";
export default {
  components: {
    NavBar,
    Footer,
    Box,
  },
  setup() {
    const cart = ref([]);

    const getCart = () => {
      axios
        .get("http://localhost/manga/manga/src/api/cart.php")
        .then((res) => {
          cart.value = res.data;
          console.log(cart.value);
        })
        .catch((err) => {
          console.log("Error", err);
        });
    };
    const deleteCart = (cartItem) => {
      axios
        .post("http://localhost/manga/manga/src/api/deleteCart.php", {
          mangaId: cartItem.manga_id,
        })
        .then((res) => {
          if (res.data.message === "Delete successful") {
            window.location.reload();
          } else {
            console.log("Error when delete");
          }
        })
        .catch((err) => {
          console.log("Error", err);
        });
    };
    const updateQuantity = (cartItem) => {
      axios
        .post("http://localhost/manga/manga/src/api/updateQuantity.php", {
          mangaId: cartItem.manga_id,
          quantity: cartItem.quantity,
        })
        .then((res) => {
          if (res.data.message === "Update Successful") {
            window.location.reload();
          } else {
            console.log("Error when update");
          }
        })
        .catch((err) => {
          console.log("Error", err);
        });
    };
    const updateCart = () => {
      axios
        .post("http://localhost/manga/manga/src/api/updateCart.php")
        .then((res) => {
          if (res.data.message === "Update Cart Successful") {
            window.location.reload();
          } else {
            console.log("Error when update");
          }
        })
        .catch((err) => {
          console.log("Error", err);
        });
    };
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

    onMounted(() => {
      getCart();
      getTotal();
    });
    return {
      cart,
      deleteCart,
      updateQuantity,
      updateCart,
      total,
    };
  },
};
</script>

<style scoped>
@import url(../style/cart.scss);
</style>
