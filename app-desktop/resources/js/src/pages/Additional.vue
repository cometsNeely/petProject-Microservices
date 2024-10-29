<script setup>

import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useStore } from 'vuex'

const store = useStore()
const router = useRouter()

</script>

<template>
	<div class="row">
    <div class="col-sm-12">
        <button class="btn btn-success btn-md">Button me now!</button>&nbsp;
	</div>
	</div>
</template>



