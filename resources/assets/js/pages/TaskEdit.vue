<template>
  <div>
    <navi></navi>
    <div class="container">
      <input type="text" class="form-control" placeholder="タイトル">
      <textarea class="form-control"></textarea>
      <button type="button" class="btn btn-primary" @click="save">保存</button>
    </div>
  </div>
</template>

<script>
  import Navi from "../components/Navi";

  export default {
    components: {
      Navi
    },
    methods: {
      save() {
        this.$router.push({ path: "/task" });
      }
    }
  };
</script>