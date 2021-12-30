<template>
  <div>
    <button
      type="button"
      class="btn m-0 p-1 shadow-none"
    >
      <i class="fas fa-star fa-2x mr-1"
        :class="{'yellow-text':this.isBookmarkedBy, 'animated heartBeat fast':this.gotToBookmark}"
        @click="clickBookmark" 
      />
    </button>
    {{ countBookmarks }}
  </div>
</template>

<script>
  export default {
    props: {
      initialIsBookmarkedBy: {
        type: Boolean,
        default: false,
      },
      initialCountBookmarks: {
        type: Number,
        default: 0,
      },
      authorized: {
        type: Boolean,
        default: false,
      },
      endpoint: {
        type: String,
      },
    },
    data() {
      return {
        isBookmarkedBy: this.initialIsBookmarkedBy,
        countBookmarks: this.initialCountBookmarks,
        gotToBookmark: false,
      }
    },
    methods: {
      clickBookmark() {
        if (!this.authorized) {
          alert('いいね機能はログイン中のみ使用できます')
          return
        }

        this.isBookmarkedBy
          ? this.unbookmark()
          : this.bookmark()
      },
      async bookmark() {
        const response = await axios.put(this.endpoint)

        this.isBookmarkedBy = true
        this.countBookmarks = response.data.countBookmarks
        this.gotToBookmark = true
      },
      async unbookmark() {
        const response = await axios.delete(this.endpoint)

        this.isBookmarkedBy = false
        this.countBookmarks = response.data.countBookmarks
        this.gotToBookmark = false
      },
    },
  }
</script>
