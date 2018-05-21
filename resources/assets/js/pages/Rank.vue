<template>
  <div>
    <navi/>
    <div class="container">
      <h1>ランキング</h1>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>#</th>
            <th>ユーザ名</th>
            <th>スコア</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>hoge</td>
            <td>114514</td>
          </tr>
        </tbody>
      </table>
      <h1>自分のランク</h1>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th>#</th>
            <th>ユーザ名</th>
            <th>スコア</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>hoge</td>
            <td>114514</td>
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
  }
};
</script>
