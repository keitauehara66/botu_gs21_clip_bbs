import './bootstrap'
import Vue from 'vue'
import ThreadBookmark from './components/ThreadBookmark'
import ThreadTagsInput from './components/ThreadTagsInput'

const app = new Vue({
  el: '#app',
  components: {
    ThreadBookmark,
    ThreadTagsInput,
  }
})