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
</template>

<script>
export default {};
</script>

<style>
@import url("../style/navbar.scss");
</style>
