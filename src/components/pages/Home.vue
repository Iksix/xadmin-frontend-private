<script setup>

import axios from 'axios';

const getPlayers = () => {
    axios.get("api/get/players/A").then((res) => {
    console.log(res.data);
    console.log(JSON.parse(res.data));
})
}

</script>


<template>
    <div>
        Home
        <div @click="getPlayers">
            getPlayers
        </div>
    </div>
</template>