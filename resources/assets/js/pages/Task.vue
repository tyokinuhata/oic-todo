<template>
  <div>
    <navi/>
    <div class="container">
      <div class="mt-4">
        <input type="text" class="form-control" placeholder="タイトル" v-model="add.title" autofocus>
        <textarea class="form-control mt-2" placeholder="説明" rows="8" v-model="add.description"></textarea>
        <div class="text-right">
          <button type="button" class="btn btn-primary mt-2" @click="addTask()">追加</button>
        </div>
      </div>
      <div class="mt-4">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a href="#incomplete" class="nav-link active" data-toggle="tab">未完了タスク({{ lists.incomplete.length }})</a>
          </li>
          <li class="nav-item">
            <a href="#complete" class="nav-link" data-toggle="tab">完了タスク({{ lists.complete.length }})</a>
          </li>
        </ul>
        <div class="tab-content">
          <div id="incomplete" class="tab-pane active">
            <table class="table">
              <thead>
              <tr>
                <th class="text-center">タイトル</th>
                <th class="text-center">作成日</th>
                <th class="text-center" style="width: 15%;">獲得可能スコア</th>
                <th class="text-center">説明</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
              </thead>
              <tbody>
                <tr v-for="l in lists.incomplete">
                  <td>{{ l.title }}</td>
                  <td class="text-center">{{ ((l.reopen_at).substr(0, 10)).replace(/-/g, '/') }}</td>
                  <td class="text-center">{{ l.acceptable_score }}pt</td>
                  <td>{{ l.description }}</td>
                  <td>
                    <button type="button" class="btn btn-primary" @click="closeTask(l.task_id)">完了</button>
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
                <th class="text-center">タイトル</th>
                <th class="text-center">完了日</th>
                <th class="text-center" style="width: 10%;">獲得スコア</th>
                <th class="text-center">説明</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>&nbsp;</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="l in lists.complete">
                <td>{{ l.title }}</td>
                <td class="text-center">{{ ((l.closed_at).substr(0, 10)).replace(/-/g, '/') }}</td>
                <td class="text-center">{{ l.score }}pt</td>
                <td>{{ l.description }}</td>
                <td>
                  <button type="button" class="btn btn-warning" @click="reopenTask(l.task_id)">未完了</button>
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
      .then(response => {
        this.getCompleteTask()
        this.getIncompleteTask()
      })
    },
    updateTask(taskId) {
      this.update.taskId = taskId
    },
    deleteTask(taskId) {
      axios.post('/api/task/delete', {
        token: this.token,
        task_id: taskId
      })
      .then(response => {
        this.getCompleteTask()
        this.getIncompleteTask()
      })
    },
    closeTask(taskId) {
      axios.post('/api/task/close', {
        token: this.token,
        task_id: taskId
      })
      .then(response => {
        this.getCompleteTask()
        this.getIncompleteTask()
      })
    },
    reopenTask(taskId) {
      axios.post('/api/task/reopen', {
        token: this.token,
        task_id: taskId
      })
      .then(response => {
        this.getCompleteTask()
        this.getIncompleteTask()
      })
    },
    getCompleteTask() {
      axios.post('/api/task/list/complete', {
        token: this.token
      })
      .then(response => {
        this.lists.complete = []
        for (let d of response.data) {
          this.lists.complete.push(d);
        }
      })
    },
    getIncompleteTask() {
      axios.post('/api/task/list/incomplete', {
        token: this.token
      })
      .then(response => {
        this.lists.incomplete = []
        for (let d of response.data) {
          this.lists.incomplete.push(d);
        }
      })
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
    this.getCompleteTask()
    this.getIncompleteTask()
  }
};
</script>
