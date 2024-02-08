<script setup>
import { inject } from 'vue';

const props = defineProps({
    'ban': Object
})

const GetAdminNameBySid = inject('GetAdminNameBySid');

const admin = GetAdminNameBySid(props.ban['adminsid'])
const convertMinutes = inject('convertMinutes');
const getDateString = inject('getDateString');
</script>


<template>
    <div class="ban-item hover">
        <span>{{ ban['name'] }}</span>
        <span>{{ admin }}</span>
        <span>{{ ban['reason'] }}</span>
        <span>{{ ban.time == 0 ? "Infinity" : convertMinutes(ban.time / 60) }}</span>
        <span :class="[{'banned' : ((Date.now() * 1000 < ban.end) || ban.time == 0) && ban.Unbanned == 0}, 
        {'unbanned' : ((Date.now() * 1000 > ban.end) && ban.time != 0) || ban.Unbanned ==1}]">
        {{ getDateString(ban.created).split(',')[0] }}</span>
    </div>
</template>