<template>
  <div>
    <navi/>
    <div class="container">
      <div>
        <input type="text" class="form-control" placeholder="タイトル" v-model="task.title">
        <textarea class="form-control" v-model="task.description"></textarea>
        <button type="button" class="btn btn-primary" @click="addTask()">追加</button>
      </div>
      <div>
        <table class="table">
          <thead>
            <tr>
              <th>タイトル</th>
              <th>説明</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>hoge</td>
              <td>hogehoge</td>
              <td>
                <button type="button" class="btn btn-primary">完了</button>
              </td>
              <td>
                <router-link to="/task/edit" class="btn btn-success">編集</router-link>
              </td>
              <td>
                <button type="button" class="btn btn-danger">削除</button>
              </td>
            </tr>
          </tbody>
        </table>
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
  data () {
    return {
      task: {
        title: '',
        description: ''
      }
    }
  },
  methods: {
    addTask() {
      const cookie = document.cookie.replace(/\s+/g, '').split(';')
      let token
      for (let c of cookie) {
        if (c.indexOf('token') >= 0) {
          token = c.slice(6)
        }
      }
      axios.post('/api/task/add', {
        token: token,
        title: this.task.title,
        description: this.task.description
      })
      .then(response => {
        console.log(response)
      })
    }
  }
};
</script>
