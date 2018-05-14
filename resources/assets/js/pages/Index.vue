<template>
  <div class="container">
    <h1>todoom</h1>
    <p>todoomはポイントで競い合う新感覚TODOアプリです。</p>
    <div>
      <div>
        <label for="user-id">ユーザID</label>
        <input 
          id="user-id" 
          v-model="userId" 
          type="text" 
          class="form-control">
      </div>
      <div>
        <label for="password">パスワード</label>
        <input 
          id="password" 
          v-model="password" 
          type="password" 
          class="form-control">
      </div>
      <button 
        type="button" 
        class="btn btn-primary" 
        @click="signIn()">サインイン</button>
      <router-link to="/signup">サインアップはこちら</router-link>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      userId: "",
      password: ""
    };
  },
  methods: {
    signIn() {
      axios
        .post("/api/auth/token", {
          user_id: this.userId,
          password: this.password
        })
        .then(response => {
          document.cookie = "token=" + response.data;
          this.$router.push({ path: "/task" });
        })
        .catch(error => {
          console.log(error.response);
        });
    }
  }
};
</script>
