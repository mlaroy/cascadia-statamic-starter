# Cascadia: A Starter Kit for Statamic

Cascadia is a mostly-unopinionated starter kit, with just enough CSS and JS to get you going with the essentials.

![Cascadia Starter Logo](cascadia-kit.jpg)

## Components
Cascadia comes with a bunch of Page Builder components with some sensible presets that you can customize to your liking. These include:
- Accordion
- Blog Teaser
- Contact Form
- CTA Bumper
- Google Map
- Hero
- Image Carousel
- Intro
- Tabs Explorer

### Google Maps

To use the Google Maps component, be sure to add your API key as `GOOGLE_MAP_API` in your `.env` file.

## Sets
In addition, it has a few Sets built in that you can insert into any Bard field:
- Blockquote
- Image Carousel
- Tabbed Content

Cascadia leverages Alpine.js and TailwindCSS, such that you can configure the views to your liking. For the carousel, it includes [Splide](https://splidejs.com/)

## Navigation

Cascadia comes with 2 separate Navs out of the box, with the secondary nav being placed either in a smaller menu above the main nav, or in an off-canvas drawer, which can be configured in the Globals -> Site Config.
