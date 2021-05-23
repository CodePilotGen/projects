<template>
  <div id="app">
    <header class="app-header">
      <h1 class="app-heading">
       <!--  <span>Hypothesis</span>
        <span>Questions</span>
 -->      </h1>
    </header>
    <router-view/>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 30px;
}
</style>
