<template>
  <div id="app">
    <div id="nav" v-if="this.$route.meta === 1">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link>
    </div>
    <router-view />
  </div>
</template>

<style>
</style>
