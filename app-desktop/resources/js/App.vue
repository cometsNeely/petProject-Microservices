<script setup>
	import Header from './src/components/Header.vue';
</script>

<template>
  <Header />
  <main class="main">
	<router-view />
  </main>
</template>

<style scoped>
	.main {
		width: 992px;
		margin: 0 auto;
		padding: 40px;
	}
</style>