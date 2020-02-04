<template>
  <div id="app">
    <div id="nav" v-if="this.$route.path !== '/loginadmin'">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link>
    </div>
    <router-view />
  </div>
</template>

<style>
#app {
}

</style>
