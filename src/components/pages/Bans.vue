<script setup>
import { ref, onMounted, inject} from 'vue';
import BanItem from '../BanItem.vue';
import axios from "axios";
import BanInfo from '../BanInfo.vue';

const user = inject('user');

const bans = ref(null);

const selectedBan = ref(null);

const GetPagedMassive = inject('GetPagedMassive')


const page = ref(1)
const maxPage = ref(1);
const perPage = 7



onMounted(() => {
    try {
        axios.get('api/get/bans').then((res) => {
            bans.value = res.data.reverse() ?? null
            maxPage.value = Math.floor(bans.value.length / perPage - 1) 
        });
    }
    catch (err) {
        console.log(err);
    }
})


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
                @click="selectedBan = ban"
                v-for="ban in GetPagedMassive(page, perPage, bans)"
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
