<template>
  <nav class="navbar navbar-expand-sm navbar-dark bg-primary testtt">
    <div class="container">
      <router-link 
        class="navbar-brand" 
        to="/">todoom</router-link>
      <button 
        class="navbar-toggler" 
        type="button" 
        data-toggle="collapse" 
        data-target="#navbarSupportedContent" 
        aria-controls="navbarSupportedContent" 
        aria-expanded="false" 
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"/>
      </button>

      <div 
        id="navbarSupportedContent" 
        class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <li>
            <router-link 
              class="nav-link" 
              to="/">トップ</router-link>
          </li>
          <li>
            <router-link 
              class="nav-link" 
              to="/task">タスク</router-link>
          </li>
          <li>
            <router-link 
              class="nav-link" 
              to="/rank">ランキング</router-link>
          </li>
          <li>
            <router-link 
              class="nav-link" 
              to="/user/:id">マイページ</router-link>
          </li>
          <li>
            <div 
              class="nav-link" 
              @click="signOut()">サインアウト</div>
          </li>
          <li>
            <router-link 
              class="nav-link" 
              to="/config">設定</router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  created() {
    if (document.cookie.indexOf("token") === -1) {
      this.$router.push({ path: "/" });
    }
  },
  methods: {
    signOut() {
      document.cookie = "token=; max-age=0";
      this.$store.commit('setSignedIn', false);
      this.$router.push({ path: "/" });
    }
  }
};
</script>

<style lang="scss" scoped="">
.nav-link {
  cursor: pointer;
}
</style>
