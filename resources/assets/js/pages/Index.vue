<template>
  <div>
    <div v-if="signedIn">
      <after />
    </div>
    <div v-else>
      <before />
    </div>
  </div>
</template>

<script>
import Before from "./Index/Before";
import After from "./Index/After";

export default {
  components: {
    Before,
    After
  },
  data() {
    return {
      signedIn: false
    };
  },
  created() {
    if (document.cookie.indexOf("token") === 0) {
      this.$store.commit('setSignedIn', true);
    }
    this.signedIn = this.$store.getters.signedIn
  }
};
</script>
