<template>
    <div>
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
            <div>
                <label for="confirm-password">パスワード(確認)</label>
                <input type="password" id="confirm-password" v-model="confirmPassword">
            </div>
            <button type="button" @click="signup()">サインアップ</button>
            <router-link to="/">サインインはこちら</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                userId: '',
                password: '',
                confirmPassword: ''
            }
        },
        methods: {
            signup () {
                axios.post('/api/auth/register', {
                    user_id: this.userId,
                    password: this.password,
                    password_confirm: this.confirmPassword
                })
                    .then(response => {
                        console.log(response.data)
                    })
                    .catch(error => {
                        console.log(error.response)
                    })
            }
        }
    }
</script>