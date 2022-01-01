import './bootstrap'
import Vue from 'vue'
import ThreadBookmark from './components/ThreadBookmark'
import ThreadTagsInput from './components/ThreadTagsInput'
import CommentLike from './components/CommentLike'
import FollowButton from './components/FollowButton'

const app = new Vue({
  el: '#app',
  components: {
    ThreadBookmark,
    ThreadTagsInput,
    CommentLike,
    FollowButton,
  }
})