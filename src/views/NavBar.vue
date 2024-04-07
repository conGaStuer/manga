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
          <div class="product" v-for="cartItem in cart" :key="cartItem.id">
            <div
              class="product-image"
              :style="{ backgroundImage: `url(${cartItem.hinhanh})` }"
            ></div>
            <div class="product-info">
              <div class="product-name">{{ cartItem.name }}</div>
              <div class="product-price">$ {{ cartItem.price }}.00</div>
            </div>
            <i class="fa-regular fa-circle-xmark"></i>
          </div>
        </div>
        <div class="product-prices">
          <span>Subtotal</span>
          <h5>$ {{ totalPrice.toFixed(2) }}</h5>
        </div>
        <div class="btn">
          <button>View Cart</button>
          <button>Check out</button>
        </div>
      </div>
    </Transition>
  </div>
</template>

<script>
import axios from "axios";
import { ref, onMounted, computed } from "vue";
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
    const totalPrice = computed(() => {
      return cart.value.reduce(
        (total, item) => total + parseFloat(item.price),
        0
      );
    });
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
    return {
      cart,
      showCart,
      showSideCart,
      closeCart,
      totalPrice,
    };
  },
};
</script>

<style>
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
