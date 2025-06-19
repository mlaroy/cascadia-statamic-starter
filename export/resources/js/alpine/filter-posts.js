export default () => ({
    init() {
        console.log('filter-posts.js')
    },

    activeTags: [],

    handleTagClick($event) {
        const val = $event.target.value
        if (this.activeTags.includes(val)) {
            this.activeTags = this.activeTags.filter(tag => tag !== val)
        } else {
            this.activeTags = [...this.activeTags, val]
        }
    }
})
