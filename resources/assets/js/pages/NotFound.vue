<template>
    <div class="text-center mt-4">
        <h1 class="h1">404 Not Found</h1>
        <p class="h4">(ᵔᴥᵔ) お探しのページは見つかりませんでした。残念でした。 (ᵔᴥᵔ)</p>
        <div v-if="signedIn">
            <router-link to="/task">タスクページへ</router-link>
        </div>
        <div v-else>
            <router-link to="/">トップページへ</router-link>
        </div>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        signedIn: false
      }
    },
    created() {
      if (this.$store.getters.signedIn) {
        this.signedIn = true
      }
    }
  }
</script>