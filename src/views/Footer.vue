<template>
  <div class="footer">
    <div class="social">
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
        <i class="fa-brands fa-facebook">
          <a href="https://www.facebook.com/tra.moon.10" target="_blank"></a>
        </i>
        <i class="fa-brands fa-instagram">
          <a
            href="https://www.instagram.com/ssueon_keueong/"
            target="_blank"
          ></a>
        </i>
        <i class="fa-brands fa-github">
          <a
            href="https://github.com/conGaStuer?tab=repositories"
            target="_blank"
          ></a>
        </i>
        <i class="fa-regular fa-envelope" target="_blank">
          <a
            href="https://github.com/conGaStuer?tab=repositories"
            target="_blank"
          ></a>
        </i>
      </div>
    </div>
    <span>Copyright © 2024 Manga Store | Powered by Manga Store</span>
  </div>
</template>

<script>
export default {};
</script>

<style>
@import url(../style/footer.scss);
</style>
