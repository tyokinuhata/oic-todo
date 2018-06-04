<template>
  <div>
    <navi/>
    <div class="container">
      <div>
        <input type="text" class="form-control" placeholder="タイトル" v-model="add.title">
        <textarea class="form-control" placeholder="説明" v-model="add.description"></textarea>
        <button type="button" class="btn btn-primary" @click="addTask()">追加</button>
      </div>
      <div>
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a href="#incomplete" class="nav-link active" data-toggle="tab">未完了タスク</a>
          </li>
          <li class="nav-item">
            <a href="#complete" class="nav-link" data-toggle="tab">完了タスク</a>
          </li>
        </ul>
        <div class="tab-content">
          <div id="incomplete" class="tab-pane active">
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
                <tr v-for="l in lists.incomplete">
                  <td>{{ l.title }}</td>
                  <td>{{ l.description }}</td>
                  <td>
                    <button type="button" class="btn btn-primary">完了</button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateTaskModal" @click="updateTask(l.task_id)">編集</button>
                  </td>
                  <td>
                    <button type="button" class="btn btn-danger" @click="deleteTask(l.task_id)">削除</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div id="complete" class="tab-pane">
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
              <tr v-for="l in lists.complete">
                <td>{{ l.title }}</td>
                <td>{{ l.description }}</td>
                <td>
                  <button type="button" class="btn btn-warning">未完了</button>
                </td>
                <td>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updateTaskModal" @click="updateTask(l.task_id)">編集</button>
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
    </div>
    <task-edit :taskId="update.taskId"></task-edit>
  </div>
</template>

<script>
import Navi from "../components/Navi";
import TaskEdit from "./TaskEdit";

export default {
  components: {
    Navi,
    TaskEdit
  },
  data () {
    return {
      token: '',
      add: {
        title: '',
        description: ''
      },
      lists: {
        complete: [],
        incomplete: []
      },
      update: {
        taskId: ''
      }
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
    updateTask(taskId) {
      this.update.taskId = taskId
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

    axios.post('/api/task/list/completed', {
      token: this.token
    })
    .then(response => {
      for (let d of response.data) {
        d.completed === '1' ? this.lists.complete.push(d) : this.lists.incomplete.push(d)
      }
    })
  }
};
</script>
