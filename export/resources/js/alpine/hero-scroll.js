export default () => ({

    init() {
        const scrollFunction = this.handleScroll.bind(this)
        document.addEventListener('scroll', scrollFunction);
    },

    handleScroll() {
        const content = this.$refs.content
        // const heroHeight = image.offsetHeight
        const scrolled = window.pageYOffset || document.documentElement.scrollTop;
        content.style = `transform: translate3d(0, ${scrolled * 0.3}px, 0); opacity: ${1 - (scrolled * 0.001)} `
    }
})
