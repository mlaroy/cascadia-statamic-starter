// This is all you.
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse'
import focus from '@alpinejs/focus'
import Precognition from 'laravel-precognition-alpine'

window.Alpine = Alpine;

Alpine.plugin(collapse);
Alpine.plugin(focus)
Alpine.plugin(Precognition);

import App from './alpine/app';
import GoogleMap from './alpine/google-map';
import Carousel from './alpine/carousel';
import HeroVideo from './alpine/hero-video';
// import FilterPosts from './alpine/filter-posts';
// import Testimonials from './alpine/testimonials';
// import HeroScroll from './alpine/hero-scroll';

Alpine.data('app', App);
Alpine.data('googleMap', GoogleMap);
Alpine.data('carousel', Carousel);
Alpine.data('heroVideo', HeroVideo);
// Alpine.data('heroScroll', HeroScroll);
// Alpine.data('filterPosts', FilterPosts);
// Alpine.data('testimonials', Testimonials);

Alpine.start();
