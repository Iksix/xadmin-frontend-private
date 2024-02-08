<script setup>
import { inject } from 'vue';

const SubFolder = import.meta.env.VITE_SUBFOLDER;
console.log(SubFolder);
const user = inject('user')
const UserHaveWebFlag = inject('UserHaveWebFlag')


</script>

<template>
    <header class="header">
        <div class="side">
            <b class="logo">
                <span>X</span>
                <span>ADMIN</span>
            </b>
            <div class="separator-ver"></div>
            <RouterLink :to="{name : 'home'}">Home</RouterLink>

            <RouterLink :to="{name : 'bans'}">Bans</RouterLink>
            <RouterLink :to="{name : 'mutes'}">Mutes</RouterLink>
            <RouterLink :to="{name : 'gags'}">Gags</RouterLink>

            <RouterLink v-if="UserHaveWebFlag(user, 'a')" :to="{name : 'adminpanel'}">Admin</RouterLink>
        </div>
        <div class="side">
            <RouterLink v-if="user != null" :to="{name : 'profile'}">Profile</RouterLink>
            <a v-if="user != null" href="api/logout">Logout</a>
            <a v-if="user == null" href="api/login">Login</a>
        </div>
        
    </header>
</template>