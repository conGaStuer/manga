<template>
  <nav>
    <div class="nav_bar">
      <h4>
        <router-link to="/"> Naoki Urasawa</router-link>
      </h4>
      <ul>
        <li>
          <router-link to="/">Home</router-link>
        </li>
        <li>
          <router-link to="/mangas">Mangas</router-link>
        </li>
        <li>
          <router-link to="/about">About Author</router-link>
        </li>
        <li>
          <router-link to="/blog">Blog</router-link>
        </li>
        <li>
          <router-link to="/contact">Contact</router-link>
        </li>
      </ul>

      <div>
        <i class="fa-solid fa-basket-shopping" @click="showSideCart"></i>
      </div>
    </div>
  </nav>
  <div class="overlay" v-if="showCart">
    <Transition appear name="slide">
      <div class="cart-side">
        <div class="shopping">
          <span>Shopping Cart</span>
          <i class="fa-solid fa-x" @click="closeCart"></i>
        </div>
        <div class="product-list">
          <router-link
            class="product"
            v-for="cartItem in cart"
            :key="cartItem.id"
            :to="`/mangas/${cartItem.manga_id}`"
            @click="reset"
          >
            <div
              class="product-image"
              :style="{ backgroundImage: `url(${cartItem.hinhanh})` }"
            ></div>
            <div class="product-info">
              <div class="product-name">{{ cartItem.name }}</div>
              <div class="product-price">
                {{ cartItem.quantity }} x $ {{ cartItem.price }}.00
              </div>
            </div>
            <i
              class="fa-regular fa-circle-xmark"
              @click="deleteCart(cartItem)"
            ></i>
          </router-link>
        </div>
        <div class="product-prices">
          <span>Subtotal</span>
          <h5>$ {{ total }}.00</h5>
        </div>
        <div class="btn">
          <button><router-link to="/cart">View Cart</router-link></button>
          <button>Check out</button>
        </div>
      </div>
    </Transition>
  </div>
</template>

<script>
import axios from "axios";
import { ref, onMounted, computed } from "vue";
import { useRoute, useRouter } from "vue-router";
export default {
  setup() {
    const cart = ref([]);
    const showCart = ref(false);

    const closeCart = () => {
      showCart.value = false;
    };
    const showSideCart = () => {
      showCart.value = true;
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
            console.log("Error");
          }
        })
        .catch((err) => {
          console.log("Error", err);
        });
    };
    onMounted(() => {
      axios
        .get("http://localhost/manga/manga/src/api/cart.php")
        .then((res) => {
          cart.value = res.data;
        })
        .catch((err) => {
          console.log("Error", err);
        });
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
    const reset = () => {
      // window.Location.href = window.Location.href;
      console.log(window.Location.href);
    };
    onMounted(() => {
      getTotal();
    });
    return {
      cart,
      showCart,
      showSideCart,
      closeCart,
      deleteCart,
      total,
      getTotal,
      reset,
    };
  },
};
</script>

<style scoped>
@import url("../style/navbar.scss");
.slide-enter-active,
.slide-leave-active {
  transition: transform 0.5s;
}
.slide-enter-from {
  transform: translateX(100%);
}
.slide-enter-to {
  transform: translateX(0);
}

.slide-leave-to {
  transform: translateX(100%);
}
</style>
