import Splide from '@splidejs/splide';
// or only core styles
import '@splidejs/splide/css/core';

export default ({ autoPlay = false, perPage = 1 } = {}) => ({
    init() {
        const slider = new Splide(this.$refs.carousel, {
            useIndex: true,
            arrows: false,
            autoplay: autoPlay,
            perPage: perPage,
            pagination: false,
        }).mount();

        this.totalSlides = slider.length;

        // Splide is the only source of truth for the active slide — go()
        // no-ops at a boundary on a non-looping carousel, so tracking
        // activeIndex by incrementing it alongside go() (as this used to)
        // drifts out of sync with what's actually on screen.
        slider.on('active', (slide) => {
            this.activeIndex = slide.index;
            this.updateButtonState();
        });

        this.carousel = slider;
        this.updateButtonState();
    },

    carousel: null,
    activeIndex: 0,
    totalSlides: 0,

    nextSlide() {
        Alpine.raw(this.carousel).go('+');
    },

    prevSlide() {
        Alpine.raw(this.carousel).go('-');
    },

    updateButtonState() {
        // Disable previous button if at the start
        this.isPrevDisabled = this.activeIndex === 0;
        // Disable next button if at the end
        this.isNextDisabled = this.activeIndex === this.totalSlides - 1;
    },

    isPrevDisabled: false,
    isNextDisabled: false,
});
