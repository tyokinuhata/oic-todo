<template>
  <div>
    <navi/>
    <div class="container">
      <div>
        <input type="text" class="form-control" placeholder="タイトル">
        <textarea class="form-control"></textarea>
        <button type="button" class="btn btn-primary">追加</button>
      </div>
      <div>
        <table class="table">
          <thead>
            <tr>
              <td>タイトル</td>
              <td>説明</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
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
                <button type="button" class="btn btn-success">編集</button>
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
  }
};
</script>
