import Splide from '@splidejs/splide';
// or only core styles
import '@splidejs/splide/css/core';


export default (autoPlay = false ) => ({
    init() {

        const slider = new Splide( this.$refs.carousel,  {
            useIndex: true,
            arrows: false,
            autoplay: autoPlay
        }).mount();

        this.totalSlides = slider.length;

        const onSlideChange = index => {
            // console.log({index});
            this.activeIndex = index;
        }

        // Bind event listener
        slider.on('active', (slide) => onSlideChange(slide.index));
        this.carousel = slider;

        // Initialize button state
        this.updateButtonState();
        // // trigger resize to get flickity to layout properly
        // window.dispatchEvent(new Event('resize'));
    },

	carousel: null,
    activeIndex: 0,
    totalSlides: 0,

	nextSlide() {
        const slider = Alpine.raw(this.carousel);
		slider.go('+')
        this.activeIndex++;
        this.updateButtonState();
	},

	prevSlide() {
		const slider = Alpine.raw(this.carousel);
		slider.go('-');
        this.activeIndex--;
        this.updateButtonState();
	},

    updateButtonState() {
        // Disable previous button if at the start
        this.isPrevDisabled = this.activeIndex === 0;
        // Disable next button if at the end
        this.isNextDisabled = this.activeIndex === this.totalSlides - 1;
    },

    isPrevDisabled: false,
    isNextDisabled: false
});
