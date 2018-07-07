<template>
  <div class="modal fade" id="updateTaskModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title">タスク内容の編集</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="text" class="form-control" placeholder="タイトル" v-model="title" maxlength="32" autofocus>
          <textarea class="form-control" placeholder="説明" v-model="description" maxlength="1024"></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" @click="updateTask()">保存</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: [
      'taskId',
      'title',
      'description'
    ],
    data() {
      return {
        token: '',
      }
    },
    methods: {
      updateTask() {
        axios.post('/api/task/update', {
          token: this.token,
          task_id: this.taskId,
          title: this.title,
          description: this.description
        })
        // TODO: emitで実装したい
        location.reload()
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
    }
  }
</script>