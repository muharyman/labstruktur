<template>
  <div id="app">
    <div id="nav" v-if="this.$route.path !=='/lupapassword' ">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link>
    </div>
    <router-view />
  </div>
</template>

<style>
</style>
