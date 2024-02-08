<script setup>
import router from '@/router';
import { inject, ref, provide } from 'vue';
import axios from "axios";
import ServerList from '../ServerList.vue';

const user = inject('user');
const UserHaveWebFlag = inject('UserHaveWebFlag')

if (!UserHaveWebFlag(user.value, 'a')) {
    router.push({ name: 'home' })
}
const SuccessToast = inject('SuccessToast');


const selectedMenu = ref(null);

const servers = ref([])

if (UserHaveWebFlag(user.value, 'z')) {
    axios.get('api/get/servers').then((res) => {
        servers.value = res.data
        console.log(servers.value);
    });
}

const SetServers = () => {
    axios.get('api/get/servers').then((res) => {
        servers.value = res.data
        console.log(servers.value);
    });
}

const AddServer = (Server) => {
    axios.post('api/add/server', Server).then((res) => {
        if (res.data == true) {
            SuccessToast("Server added!")
            SetServers()
        }
    })
}

const DeleteServer = (id) => {
    axios.post('api/delete/server', {arg : id}).then((res) => {
        if (res.data == true) {
            SuccessToast("Server deleted!")
            SetServers()
        }
    })
}

provide("AddServer", AddServer)
provide("DeleteServer", DeleteServer)

</script>


<template>
    <div style="margin-top: 48px;" class="content">
        <div class="select-admin-panel">
            <span 
            @click="selectedMenu = 'servers'; SetServers()" 
            :class="[{'active' : selectedMenu == 'servers'}, 'select-item']"
            >Servers</span>

            <span 
            @click="selectedMenu = 'admins'" 
            :class="[{'active' : selectedMenu == 'admins'}, 'select-item']"
            >Admins</span>
        </div>
        <div class="panel">
            <ServerList v-if="selectedMenu == 'servers'" :servers="servers"/>
        </div>
    </div>
</template>