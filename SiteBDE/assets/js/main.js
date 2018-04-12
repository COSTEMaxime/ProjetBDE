import Vue from 'vue'
import App from './App'
import Register from './UserGestion/Register'

new Vue({
  el: '#app',
  template: '<App/>',
  components: { App }
});

new Vue({
    el: '#register',
    template: '<Register/>',
    components: { Register }
});
