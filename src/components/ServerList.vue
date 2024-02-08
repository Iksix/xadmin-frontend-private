<script setup>
import { ref, inject } from 'vue';

defineProps({
    'servers': Object
})

const rconViewId = ref(null)
const addServer = ref(false)

const AddServer = inject("AddServer")
const DeleteServer = inject("DeleteServer")


const serverAdd = ref({
    name: "",
    ip: "",
    port: "",
    rcon: "",
    server_id: ""
})



</script>

<template>
    <div class="content">
        <div class="server-list">
            <div class="server head">
                <span class="server-item">Name</span>
                <span class="server-item">Ip</span>
                <span class="server-item">Port</span>
                <span class="server-item">Rcon</span>
                <span class="server-item">ServerID</span>
            </div>
            <div v-for="server in servers" :key="server.id" class="server">

                <span class="server-item">{{ server.name }}</span>
                <span class="server-item">{{ server.ip }}</span>
                <span class="server-item">{{ server.port }}</span>
                <span @click="rconViewId = rconViewId == server.id ? null : server.id" class="server-item rconpass">{{ rconViewId == server.id ? server.rcon : "Show*" }}</span>
                <span class="server-item">{{ server.server_id }}</span>

                <i class="fa-solid fa-trash control-back control-delete" @click="DeleteServer(server.id)"></i>
            </div>

            
            <!-- Server add -->
            <div v-if="addServer" class="server add">
                <input v-model="serverAdd.name" placeholder="Name" class="server-item">
                <input v-model="serverAdd.ip" placeholder="Ip" class="server-item">
                <input v-model="serverAdd.port" placeholder="Port" class="server-item">
                <input v-model="serverAdd.rcon" placeholder="Rcon" class="server-item">
                <input v-model="serverAdd.server_id" placeholder="ServerID" class="server-item">
            </div>

            <div class="control">
                <i v-if="!addServer" @click="addServer = true" class="fa-solid fa-plus control-plus"></i>

                <i v-if="addServer" @click="AddServer(serverAdd); addServer = false" class="fa-solid fa-check control-save"></i>
                <i v-if="addServer" @click="addServer = false" class="fa-solid fa-xmark control-back"></i>
            </div>
        </div>
    </div>
</template>


<style scoped>

</style>