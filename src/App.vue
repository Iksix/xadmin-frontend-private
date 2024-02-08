<script setup>
import axios from "axios";
axios.get('api/sanctum/csrf-cookie')

import { onMounted, provide, ref } from "vue";
import Header from "./components/Header.vue"
import { useToast } from "vue-toastification";
import successSound from './assets/sounds/success.wav';
const playSounds = import.meta.env.VITE_PLAYSOUNDS
const toast = useToast();

const CopiedToast = () => {
  if (playSounds == 'true')
  {
    let audio = new Audio(successSound);
    audio.volume = 0.8
    audio.play()
  }
  toast.success("Copied", {
  position: "top-center",
  timeout: 1800,
  toastClassName: "custom-toast",
  closeOnClick: true,
  pauseOnFocusLoss: false,
  pauseOnHover: false,
  draggable: false,
  draggablePercent: 0.6,
  showCloseButtonOnHover: true,
  hideProgressBar: false,
  closeButton: "button",
  icon: true,
  rtl: false
});
}

const SuccessToast = (text) => {
  if (playSounds == 'true')
  {
    let audio = new Audio(successSound);
    audio.volume = 0.8
    audio.play()
  }
  toast.success(text, {
  position: "top-center",
  timeout: 1800,
  toastClassName: "custom-toast",
  closeOnClick: true,
  pauseOnFocusLoss: false,
  pauseOnHover: false,
  draggable: false,
  draggablePercent: 0.6,
  showCloseButtonOnHover: true,
  hideProgressBar: false,
  closeButton: "button",
  icon: true,
  rtl: false
});
}
const ErrorToast = (text) => {
  toast.error(text, {
  position: "top-center",
  timeout: 1800,
  toastClassName: "custom-toast-error",
  closeOnClick: true,
  pauseOnFocusLoss: false,
  pauseOnHover: false,
  draggable: false,
  draggablePercent: 0.6,
  showCloseButtonOnHover: true,
  hideProgressBar: false,
  closeButton: "button",
  icon: true,
  rtl: false
});
}

provide("CopiedToast", CopiedToast)
provide("SuccessToast", SuccessToast)
provide("ErrorToast", ErrorToast)




axios.defaults.withXSRFToken = true

const user = ref(null)
const admins = ref(null)

onMounted(() => {
  // Получаем пользователя
  try {
    axios.get('api/sanctum/csrf-cookie').then(async () => {
      axios.get('api/user').then((res) => {
        user.value = res.data
      })
    });
  }
  catch (err) {
    console.log(err);
  }

  // Получаем админов
  try {
    axios.get('api/get/admins').then(async (r) => {
      admins.value = r.data
    });
  }
  catch (err) {
    console.log(err);
  }
})


const UserHaveWebFlag = (user, flag) => {
  if (user == null) return false
  if (user.web_flags.includes(flag) || user.web_flags.includes('z')) return true
  return false
}
const ThisUserHaveWebFlag = (flag) => {
  if (this.user == null) return false
  if (this.user.web_flags.includes(flag) || this.user.web_flags.includes('z')) return true
  return false
}

const GetAdminBySid = (sid) => {
  if (admins.value == null) return null
  admins.value.forEach(admin => {
    if (admin.sid == sid) return admin;
  });
  return null
}

const GetAdminNameBySid = (sid) => {
  if (admins.value == null) {
    return 'Unknown'
  }

  if (sid.toLowerCase() == 'console') {
    return 'Console'
  }

  for (const admin in admins.value) {
    if (admins.value[admin].sid == sid){
      return admins.value[admin].name
    }
  }

  return 'Unknown'
}

const CopyToClipboard = (text) => {
    navigator.clipboard.writeText(text);
    CopiedToast();
}


const getDateString = (unix_timestamp) => {
    var date = new Date(unix_timestamp * 1000);
// Hours part from the timestamp
    const enUS = date.toLocaleTimeString('ru-Ru', {
        day: '2-digit',
        month: '2-digit',
        year: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'

    });
    return enUS
}

const convertMinutes = (minutes) => {
  var units = {
    "y": 24*60*365,
    "mo": 24*60*30,
    "w": 24*60*7,
    "d": 24*60,
    "h" : 60,
    "m": 1
  }

  var result = []

  for(var name in units) {
    var p =  Math.floor(minutes/units[name]);
    if(p == 1) result.push(p + name);
    if(p >= 2) result.push(p + name);
    minutes %= units[name]
  }
  return result.toString().replaceAll(',', ' ')
}


const GetPagedMassive = (page, perPage, massive) => {
  let result = []

  for (let index = (page-1)*perPage; index < ((page-1)*perPage)+perPage; index++) {
    
    if (massive[index] == null) break

    result.push(massive[index]);
    
  }

  return result
}

provide('user', user)
provide('admins', admins)
provide('CopyToClipboard', CopyToClipboard)
provide('GetPagedMassive', GetPagedMassive)
provide('getDateString', getDateString)
provide('convertMinutes', convertMinutes)
provide('UserHaveWebFlag', UserHaveWebFlag)
provide('ThisUserHaveWebFlag', ThisUserHaveWebFlag)
provide('GetAdminBySid', GetAdminBySid)
provide('GetAdminNameBySid', GetAdminNameBySid)

</script>

<template>
  <div class="content">
    <Header />
    <router-view />
  </div>
</template>

<style scoped>

</style>
