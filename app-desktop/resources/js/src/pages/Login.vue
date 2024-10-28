<template>
    <!-- Email input -->
    <div data-mdb-input-init class="form-outline mb-4">
      <input v-model="user.email" type="email" id="form2Example1" class="form-control" />
      <label class="form-label" for="form2Example1">Email address</label>
    </div>
  
    <!-- Password input -->
    <div data-mdb-input-init class="form-outline mb-4">
      <input v-model="user.password" type="password" id="form2Example2" class="form-control" />
      <label class="form-label" for="form2Example2">Password</label>
    </div>
  
    <!-- Submit button -->
    <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4" @click="login()">Sign in</button>

    <div class="alert alert-success" role="alert" v-if="store.state.message.message !== '' && store.state.message.flag === 'green'">
       {{ store.state.message.message }}
      </div>
      <div class="alert alert-danger" role="alert" v-if="store.state.message.message !== '' && store.state.message.flag === 'red'">
       {{ store.state.message.message }}
      </div>
      <div v-if="store.state.errors !== null">
        <div class="alert alert-danger" role="alert" v-for="(err, name) in store.state.errors">
          <div v-for="(er, index) in err">
            {{ name }} : {{  er }}
          </div>
        </div>
      </div>
</template>

<script setup>
import { ref } from 'vue'
import { onMounted } from 'vue'
import axios from 'axios'
import { useStore } from 'vuex'

const store = useStore()

const user = ref({
    email: '',
    password: ''
})

onMounted(() => {

  if (store.state.message.message !== '' || store.state.errors !== null) {
      
      store.dispatch('getNewParamsMsgErrs')

  }

})

const login = async () => {
    await axios.get('/sanctum/csrf-cookie')
    try {
        await axios.post('/login', {
      email: user.value.email,
      password: user.value.password
    }).then(res => {
      store.state.errors = null
      store.state.message = res.data
    })
    } catch (e) {
      store.state.errors = e.response.data.errors
      return Promise.reject(e.response.data.errors)
    }
}

</script>
