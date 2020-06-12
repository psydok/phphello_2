<template>
    <div>
        <hello-home :msg="text"></hello-home>
    </div>
</template>

<script>
    import HelloHome from "./components/HelloHome";

    export default {
        name: "App",
        components: {
            HelloHome,
            'hello-home': HelloHome,
        },
    data: function () {
        return {
            text: 'Hello, Home!!'
        }
    }
}
    // import WebsocketMsg from "./components/WebsocketMsg";
    // export default {
    //     name: 'App',
    //     components: {
    //         WebsocketMsg,
    //         'websocket-msg': test,
    //         buttonClick (rowData) {
    //             const tickCount = this.ticketClickCounter
    //             if (tickCount === 0) {
    //                 this.$store.dispatch('WSConnect')
    //             } else {
    //                 this.$store.dispatch('WSDisconnect')
    //                 setTimeout(() => {
    //                     this.$store.dispatch('WSConnect')
    //                 }, 1000)
    //             }
    //             this.ticketClickCounter = tickCount + 1
    //         },
    //     }
    // }
</script>

<style scoped>

</style>