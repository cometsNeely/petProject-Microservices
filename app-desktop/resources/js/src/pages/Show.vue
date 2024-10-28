<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'
import { useRoute } from 'vue-router'
import { useStore } from 'vuex'

const message = ref('')
const successFlag = ref(false)

const route = useRoute()
const store = useStore()

// with api token
//window.axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`

const getShowData = () => {

  Echo.channel(`shows-channel.${route.path.substring(1)}`)
  .listen('.shows-app', (e) => {
    if(store.state.shows.length > 0) {
      if(!store.state.shows.some(data => data.show === e.show && data.category === e.category)){
        store.commit('addDataToShows', e)    
      }
    } else if (store.state.shows.length === 0) {
      store.commit('addDataToShows', e)
    }
  });

axios
.post('/shows', {  path: route.path, })
.then(response => { 

  successFlag.value = true

})

.catch(error => {
  if (error.message === 'Request failed with status code 401') {
    message.value = error.message
    successFlag.value = false
  }
})

}

watch(() => route.path,

    newPath => {

    Echo.channel(`shows-channel.${route.path.substring(1)}`).stopListening('.shows-app');

    getShowData()

  },

  { 

    immediate: true 

  })

</script>

<template>
  {{ store.state.shows.length }}
  <div v-if="message !== ''" class="alert alert-danger" role="alert">
    {{ message }}
  </div>
  <div v-if="successFlag === true">
  <div class="alert alert-success" role="alert" v-if="store.state.shows.length === 0">
    Please, wait for loading data...
  </div>
  <div v-for="(show, index) in store.state.shows">
  <div v-if="show.category === route.path">
    {{ index+1 }}: {{ show }} 
  </div>
  </div>
  </div>
</template>