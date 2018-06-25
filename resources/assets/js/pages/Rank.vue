<template>
  <div>
    <navi/>
    <div class="container">
      <h1 class="mt-4">TOP100ランキング</h1>
      <table class="table mt-2">
        <thead class="thead-dark">
          <tr>
            <th>#</th>
            <th>ユーザ名</th>
            <th>スコア</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user, i in users">
            <td>{{ i + 1 }}</td>
            <td>{{ user.user_id }}</td>
            <td>{{ user.total_score }}</td>
          </tr>
        </tbody>
      </table>
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
      users: []
    }
  },
  methods: {
    listRank() {
      axios.get('/api/rank/list')
        .then(response => {
          for (let d of response.data) {
            this.users.push(d)
          }
        });
    }
  },
  created() {
    this.listRank();
  }
};
</script>
