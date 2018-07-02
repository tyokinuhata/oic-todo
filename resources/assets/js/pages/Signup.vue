<template>
  <div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <h1 class="mt-4">todoom</h1>
          <p>todoomはポイントで競い合う新感覚TODOアプリです。</p>
          <div class="card">
            <div class="card-header">サインアップ</div>
            <div class="card-body">
              <div>
                <label for="user-id">ユーザID</label>
                <input
                        id="user-id"
                        v-model="userId"
                        @keyup.enter="signUp()"
                        type="text"
                        class="form-control"
                        autofocus>
              </div>
              <div class="mt-3">
                <label for="password">パスワード</label>
                <input
                        id="password"
                        v-model="password"
                        @keyup.enter="signUp()"
                        type="password"
                        class="form-control">
              </div>
              <div class="mt-3">
                <label for="confirm-password">パスワード(確認)</label>
                <input
                        id="confirm-password"
                        v-model="confirmPassword"
                        @keyup.enter="signUp()"
                        type="password"
                        class="form-control">
              </div>
              <div class="text-right mt-3">
                <router-link to="/">サインインはこちら</router-link>
                <button
                        type="button"
                        class="btn btn-primary"
                        @click="signUp()">サインアップ</button>
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
      userId: "",
      password: "",
      confirmPassword: ""
    };
  },
  methods: {
    signUp() {
      axios
        .post("/api/auth/register", {
          user_id: this.userId,
          password: this.password,
          password_confirm: this.confirmPassword
        })
        .then(response => {
          document.cookie = "token=" + response.data + "; max-age=3600";
          this.$router.push({ path: "/task" });
        })
        .catch(error => {
          console.log(error.response);
        });
    }
  }
};
</script>
