<template>
    <div class="dialog">
        <input id="input-info" v-model="info"
               placeholder="Enter info telemetry..."><br>
        <p>{{ info }}</p>
    </div>
</template>

<script>
    let info;
    import VueNativeSock from 'vue-native-websocket'
    import Vue from 'vue';

    export default {
        name: "WebsocketMsg",
        data: function(e) {
            return info
        },
        methods: {
            createAndSend() {
                Vue.use(VueNativeSock, `${window.location.protocol === 'https:' ? 'wss' : 'ws'}:://192.168.99.102:1337`,
                    {store: store, format: 'json', connectManually: true});

                this.$socket.onopen = () => {
                    console.log('WebSocket opened');

                    this.$socket.onmessage = (data) => console.log('Received data:', data.data);

                    console.log('Sending data');
                    this.$socket.sendObj({awesome: 'data'});
                }
            }

        }
    }
</script>

<style scoped>

</style>