<template>
  <div>
    <navi/>
    <div class="container">
      <div>
        <span>ユーザID: </span>
        <span>{{ user.user_id }}</span>
      </div>
      <div>
        <span>トータルスコア: </span>
        <span>{{ user.total_score }}</span>
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
