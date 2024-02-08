<script setup>
import { ref, onMounted, inject, provide} from 'vue';
import BanItem from '../BanItem.vue';
import axios from "axios";
import BanInfo from '../BanInfo.vue';
const SuccessToast = inject('SuccessToast');
const ErrorToast = inject('ErrorToast');
const user = inject('user');
axios.get('api/sanctum/csrf-cookie')

const bans = ref(null);

const selectedBan = ref(null);

const GetPagedMassive = inject('GetPagedMassive')


const page = ref(1)
const maxPage = ref(1);
const perPage = 7


const SetBans = () => {
    try {
        axios.get('api/get/bans').then((res) => {
            bans.value = res.data.reverse() ?? null
            maxPage.value = Math.floor(bans.value.length / perPage - 1) 
        });
    }
    catch (err) {
        axios.get('api/get/bans').then((res) => {
            bans.value = res.data.reverse() ?? null
            maxPage.value = Math.floor(bans.value.length / perPage - 1) 
        });
    }
};

SetBans()


const PlusPage = () => {
    if (page.value < maxPage.value) {
        page.value++;
    }
}

const MinusPage = () => {
    if (page.value > 1) {
        page.value--
    }
}


const UnbanPlayer = () => 
{
    let arg = selectedBan.value.BanType == 0 ? selectedBan.value.sid : selectedBan.value.ip
    console.log(selectedBan.value.server_id)
    axios.post('api/unban', {arg : arg, server_id : selectedBan.value.server_id })
    .then((res) => {
        if (res.data == true)
        {
            SuccessToast("Player unbanned!")
        }
        if (res.data != true)
        {
            ErrorToast("Player not unbanned!")
            console.log(res.data);
        }
        SetBans()
        selectedBan.value = bans.value.find(x => x.id == selectedBan.value.id)
    })
}

provide("UnbanPlayer", UnbanPlayer)


</script>

<template>
    <div class="split">
        <div class="ban-list">
            <div class="ban-item">
                <span>Name</span>
                <span>Admin</span>
                <span>Reason</span>
                <span>Time</span>
                <span>Created</span>
            </div>
            <template v-if="bans != null">
                <BanItem 
                v-for="ban in GetPagedMassive(page, perPage, bans)"
                @click="selectedBan = ban"
                :class="{'selected' :  selectedBan != null && ban.id == selectedBan.id}"
                :key="ban.id"
                :ban="ban"
                />
            </template>
            <div class="paginator">
                <i @click="MinusPage()" class="fa-solid fa-caret-left minus"></i>
                <span>{{ page }}</span>
                <i @click="PlusPage()" class="fa-solid fa-caret-right plus"></i>
            </div>
        </div>
        <BanInfo 
        :ban="selectedBan"
        />
    </div>
    
    
</template>
