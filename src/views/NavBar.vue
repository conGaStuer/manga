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
        <i class="fa-solid fa-basket-shopping"></i>
      </div>
    </div>
  </nav>

  <div class="cart-side">
    <div>
      <span>Shopping Cart</span>
      <i class="fa-solid fa-x"></i>
    </div>
    <div class="product-list">
      <div class="product">
        <div class="product-image">1</div>
        <div class="product-info">
          <div class="product-name">1</div>
          <div class="product-price">1</div>
        </div>
        <i class="fa-regular fa-circle-xmark"></i>
      </div>
    </div>
    <div class="product-price">
      <span>Subtotal</span>
      <span>Price</span>
    </div>
    <button>View Cart</button>
    <button>Check out</button>
  </div>
</template>

<script>
export default {};
</script>

<style>
@import url("../style/navbar.scss");
</style>
