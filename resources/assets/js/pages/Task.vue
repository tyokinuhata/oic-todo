<template>
  <div>
    <navi/>
    <div class="container">
      <div>
        <input type="text" class="form-control" placeholder="タイトル" v-model="add.title">
        <textarea class="form-control" v-model="add.description"></textarea>
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
            <tr v-for="l in lists">
              <td>{{ l.title }}</td>
              <td>{{ l.description }}</td>
              <td>
                <button type="button" class="btn btn-primary">完了</button>
              </td>
              <td>
                <router-link to="/task/edit" class="btn btn-success">編集</router-link>
              </td>
              <td>
                <button type="button" class="btn btn-danger" @click="deleteTask(l.task_id)">削除</button>
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
      token: '',
      add: {
        title: '',
        description: ''
      },
      lists: []
    }
  },
  methods: {
    addTask() {
      axios.post('/api/task/add', {
        token: this.token,
        title: this.add.title,
        description: this.add.description
      })
      .then(response => {})
    },
    deleteTask(taskId) {
      axios.post('/api/task/delete', {
        token: this.token,
        task_id: taskId
      })
      .then(response => {})
    },
    getToken() {
      const cookie = document.cookie.replace(/\s+/g, '').split(';')
      for (let c of cookie) {
        if (c.indexOf('token') >= 0) {
          this.token = c.slice(6)
          break
        }
      }
    }
  },
  created() {
    this.getToken()

    axios.post('/api/task/list', {
      token: this.token
    })
    .then(response => {
      for (let d of response.data) {
        this.lists.push(d)
      }
    })
  }
};
</script>
