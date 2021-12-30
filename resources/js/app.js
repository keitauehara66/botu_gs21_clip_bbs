import './bootstrap'
import Vue from 'vue'
import ThreadBookmark from './components/ThreadBookmark'

const app = new Vue({
  el: '#app',
  components: {
    ThreadBookmark,
  }
})