<template>
  <div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <h1 class="mt-4">todoom</h1>
          <p>todoomはポイントで競い合う新感覚TODOアプリです。</p>
          <div class="card">
            <div class="card-header">サインイン</div>
            <div class="card-body">
              <div>
                <label for="user-id">ユーザID</label>
                <input
                        id="user-id"
                        v-model="form.userId"
                        @keyup.enter="signIn()"
                        type="text"
                        class="form-control"
                        maxlength="16"
                        autofocus>
              </div>
              <div class="mt-3">
                <label for="password">パスワード</label>
                <input
                        id="password"
                        v-model="form.password"
                        @keyup.enter="signIn()"
                        type="password"
                        class="form-control"
                        maxlength="32">
              </div>
              <div class="text-right mt-3">
                <router-link to="/signup">サインアップはこちら</router-link>
                <button
                        type="button"
                        class="btn btn-primary"
                        @click="signIn()">サインイン</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        userId: "",
        password: "",
      }
    };
  },
  methods: {
    signIn() {
      axios
        .post("/api/auth/token", {
          user_id: this.form.userId,
          password: this.form.password
        })
        .then(response => {
          document.cookie = "token=" + response.data + "; max-age=3600";
          this.$store.commit('setSignedIn', true);
          this.$router.push({ path: "/task" });
        })
        .catch(error => {
          console.log(error.response);
        });
    }
  },
  created() {
    if (this.$store.getters.signedIn) {
      this.$router.push({ path: '/task' });
    }
  }
};
</script>
