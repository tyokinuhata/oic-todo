<template>
  <div>
    <navi/>
    <div class="container">
      <h1 class="h1 mt-4">マイページ</h1>
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-md-3">
              <img src="../../../assets/img/default-icon.png" alt="">
            </div>
            <div class="col-md-9 mt-4">
              <div class="h3">ユーザID: {{ user.user_id }}</div>
              <div class="h4">トータルスコア: {{ user.total_score }}pt</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Navi from "../components/Navi";

export default {
  components: {
    Navi
  },
  data() {
    return {
      token: 0,
      user: 0
    }
  },
  methods: {
    getToken() {
      const cookie = document.cookie.replace(/\s+/g, '').split(';')
      for (let c of cookie) {
        if (c.indexOf('token') >= 0) {
          this.token = c.slice(6)
          break
        }
      }
    },
    getUser() {
      axios.post('/api/user/me', {
        token: this.token
      })
        .then(response => {
          this.user = response.data
        })
    }
  },
  created() {
    this.getToken()
    this.getUser()
  }
};
</script>
