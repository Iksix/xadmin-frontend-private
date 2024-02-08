<script setup>
import { inject } from 'vue';
const CopyToClipboard = inject('CopyToClipboard');
const GetAdminNameBySid = inject('GetAdminNameBySid');
const convertMinutes = inject('convertMinutes');
const getDateString = inject('getDateString');
const UnbanPlayer = inject('UnbanPlayer')


const user = inject('user');

defineProps({
    'ban': Object || null
})


const UserHaveWebFlag = inject('UserHaveWebFlag')




</script>


<template>
    <div class="ban-info">
            <div class="not-selected" v-if="ban == null">
                <span>The ban is not selected</span>
            </div>
            <div class="selected" v-if="ban != null">
                <div class="section">
                    <span class="property-name">Name: </span>
                    <a href="#" class="property">{{ ban.name }}</a>
                </div>
                <div class="section">
                    <span class="property-name">SteamID: </span>
                    <span class="property">{{ ban.sid }}</span>
                    <span
                    @click="CopyToClipboard(ban.sid)"
                    class="copy"><i class="fa-regular fa-copy"></i></span>
                </div>
                <br>
                <div class="section">
                    <span class="property-name">Admin: </span>
                    <span class="property">{{ GetAdminNameBySid(ban.adminsid) }}</span>
                </div>
                <div v-if="GetAdminNameBySid(ban.adminsid) != 'Console'" class="section">
                    <span class="property-name">SteamID: </span>
                    <span class="property">{{ ban.adminsid }}</span>
                    <span
                    @click="CopyToClipboard(ban.adminsid)"
                    class="copy"><i class="fa-regular fa-copy"></i></span>
                </div>
                <br>
                <div class="section">
                    <span class="property-name">Ban reason: </span>
                    <span class="property">{{ ban.reason }}</span>
                </div>
                <div class="section">
                    <span class="property-name">Ban time: </span>
                    <span class="property">{{ ban.time == 0 ? "Infinity" : convertMinutes(ban.time / 60) }}</span>
                </div>
                <div class="section">
                    <span class="property-name">Ban created: </span>
                    <span class="property">{{ getDateString(ban.created) }}</span>
                </div>
                <div class="section">
                    <span class="property-name">Ban ends: </span>
                    <span class="property">{{ ban.time == 0 ? "Never" : getDateString(ban.end) }}</span>
                </div>
                <br>
                <div class="section">
                    <span class="property-name">Ban status: </span>
                    <span class="property">{{ ((ban.end > Date.now() * 1000) || ban.time == 0) && ban.Unbanned == 0 ? "Active" : ban.Unbanned == 0 ? "Expired" : "Unbanned" }}</span>
                </div>
                <div v-if="ban.Unbanned == 1" class="section">
                    <span class="property-name">Unbanned by: </span>
                    <span class="property">{{ GetAdminNameBySid(ban.UnbannedBy) }}</span>
                </div>
                <br>
                <div v-if="user != null" class="actions-section">
                    <span v-if="UserHaveWebFlag(user, 'e') && (((ban.end > Date.now() * 1000) || ban.time == 0) && ban.Unbanned == 0)" class="action-btn edit">Edit</span>
                    <span @click="UnbanPlayer()" v-if="UserHaveWebFlag(user, 'u') && (((ban.end > Date.now() * 1000) || ban.time == 0) && ban.Unbanned == 0)" class="action-btn unban">Unban</span>
                    <span v-if="UserHaveWebFlag(user, 'b') && !(((ban.end > Date.now() * 1000) || ban.time == 0) && ban.Unbanned == 0)" class="action-btn ban-again">Ban again</span>
                </div>
                <br>
            </div>
        </div>
</template>