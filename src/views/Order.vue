<template>
  <NavBar></NavBar>
  <div class="check">Checkout</div>
  <div class="form-cart">
    <div class="form-info">
      <span>Billing details</span>
      <div>
        <p>Your Name <b>*</b></p>
        <input type="text" />
      </div>
      <div>
        <p>Company name (optional)</p>
        <input type="text" />
      </div>
      <div>
        <p>Street address <b>*</b></p>
        <input type="text" placeholder="House number and street name" />
        <br />
        <input type="text" placeholder="Apartment, suite, unit,...." />
      </div>
      <div>
        <p>Town / City <b>*</b></p>
        <input type="text" />
      </div>
      <div>
        <p>Phone <b>*</b></p>
        <input type="text" v-model="phone" required />
      </div>
      <div>
        <p>Email address <b>*</b></p>
        <input type="text" />
      </div>
      <div>
        <p>Notes:</p>
        <textarea name="" id="" cols="30" rows="10"></textarea>
      </div>
    </div>
    <div class="form-order">
      <h2>Your Order</h2>
      <div>
        <h5>Product</h5>
        <h5>Subtotal</h5>
      </div>
      <div v-for="cartItem in cart" :key="cartItem.manga_id">
        <span>
          {{ cartItem.name }}
        </span>
        <span> $ {{ cartItem.price }}.00 </span>
      </div>
      <div>
        <span>Total</span>
        <span>$ {{ total }}.00</span>
      </div>
      <button @click="addToOrder">Order</button>
    </div>
  </div>
  <Box></Box>
  <Footer></Footer>
</template>

<script>
import { onMounted, ref, computed } from "vue";
import axios from "axios";
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
    const cart = ref([]);
    const phone = ref("");
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
    const addToOrder = () => {
      const cartItemsToSend = cart.value.map((item) => {
        return {
          name: item.name,
          price: item.price,
          quantity: item.quantity,
          manga_id: item.manga_id,
          hinhanh: item.hinhanh,
        };
      });
      axios
        .post("http://localhost/manga/manga/src/api/order.php", {
          cartItems: cartItemsToSend,
          phone: phone.value,
        })
        .then((res) => {
          if (res.data.message === "Add to order success") {
            window.location.href = "./order_detail";
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
    return { cart, addToOrder, total, phone };
  },
};
</script>

<style scoped>
@import url(../style/order.scss);
</style>
