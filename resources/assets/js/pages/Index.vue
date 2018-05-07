<template>
    <div class="container">
        <h1>todoom</h1>
        <p>todoomはポイントで競い合う新感覚TODOアプリです。</p>
        <div>
            <div>
                <label for="user-id">ユーザID</label>
                <input type="text" id="user-id" v-model="userId">
            </div>
            <div>
                <label for="password">パスワード</label>
                <input type="password" id="password" v-model="password">
            </div>
            <router-link to="/signup">サインアップはこちら</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                userId: '',
                password: ''
            }
        },
    }
</script>