<template>
    <div>
        <navi></navi>
        <router-view></router-view>
    </div>
</template>

<script>
    import Navi from './Navi'

    export default {
        components: {
            Navi
        }
    }
</script>