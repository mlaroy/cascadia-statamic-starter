// export default (length = 4) => ({
//     init() {
//         console.log('testimonials')
//         this.length = length

//         const func = this.intervalFunc.bind(this)
//         this.timer = setInterval(func, 5000)
//     },

//     activeIndex: 0,
//     length: 0,
//     timer: null,

//     intervalFunc() {
//         this.activeIndex = this.activeIndex === this.length - 1 ? 0 : this.activeIndex + 1
//     },

//     updateIndex(index) {
//         clearInterval(this.timer)
//         this.timer = setInterval(this.intervalFunc, 5000)
//         this.activeIndex = index
//     },
// })


import Flickity from 'flickity';
import 'flickity-fade';

export default () => ({
    init() {

		const flkty = new Flickity( this.$refs.carousel, {
			pageDots: true,
			draggable: false,
			contain: true,
            autoPlay: 5000,
            fade: true,
			wrapAround: false,
			prevNextButtons: false,
			initialIndex: 0,

		})
		this.carousel = flkty;
    },

	carousel: null,

	nextSlide() {
		this.carousel.next()
	},

	prevSlide() {
		this.carousel.previous()
	}
});
