---
id: home
blueprint: pages
title: Home
template: home
author: b3154f8e-5ed4-4804-a31c-5b768efc6e8e
updated_by: b3154f8e-5ed4-4804-a31c-5b768efc6e8e
updated_at: 1770407214
page_blocks:
  -
    id: ltgcaf0k
    main_heading: 'Cascadia Starter'
    sub_heading: 'A Starter Kit for Statamic, featuring TailwindCSS and AlpineJS'
    type: hero
    enabled: true
    cta_link: 96920a7d-9b68-47c6-ad50-fe8906b8c6ab
    cta_text: 'Read More About It'
    modal_type: video
    video: 'https://www.youtube.com/watch?v=nW6Jr38iHdI'
    add_modal: false
    show_modal: true
    button_text: 'Show Trailer'
    modal_id: hero
    modal_button_text: 'Show Video'
    modal_video: 'https://www.youtube.com/embed/dQw4w9WgXcQ?si=CAlHXyvhClxIscOf'
    background_option: video
    darken_bg: true
    theme: accent
    video_source: asset
    video_file: 3135808-hd_1920_1080_24fps.mp4
  -
    id: lu1r429d
    heading: 'Welcome to the Cascadia Starter Kit'
    intro_layout: horizontal
    type: intro
    enabled: true
    theme: accent
    link_style: inverted
    linked_entry: 96920a7d-9b68-47c6-ad50-fe8906b8c6ab
    link_to_external: false
    description:
      -
        type: paragraph
        content:
          -
            type: text
            text: 'The Cascadia Starter Kit is meant to be a more-or-less un-opinionated starter for developers. It has a number of common features already included in a Page Builder, with components that are easy to style according to your design.'
    override_link_text: true
    button_text: 'Read more about it'
  -
    id: mfvoy1ty
    theme: muted
    eyebrow_text: 'Great Clients'
    heading: 'Your High Profile Clients'
    description:
      -
        type: paragraph
        content:
          -
            type: text
            text: 'Look at all the impressive companies we have done work for. '
          -
            type: hardBreak
          -
            type: text
            text: 'Here are their logos.'
    logos:
      - columbia.png
      - north_face.png
      - arcteryx.png
      - mec_png.png
    type: logo_cloud
    enabled: true
  -
    id: mfygckxt
    theme: default
    media_type: image
    video_field: 'https://www.youtube.com/watch?v=KifwE5K0OmI'
    type: large_media
    enabled: true
    eyebrow_text: 'Large Media'
    heading: 'An Image or a Video'
    description:
      -
        type: paragraph
        content:
          -
            type: text
            text: 'Choose between a large image or a video embed to go here. Engage your audience with your media of choice!'
    image: hiker.jpg
  -
    id: ltg2wqkz
    heading: 'Accessible Tabbed Content'
    tab_items:
      -
        id: ltg2wwy6
        title: Hiking
        image:
          - under-city-iron-bridge.jpeg
          - hiker.jpg
        description:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                text: 'Hiking is pretty awesome.'
        type: tab_item
        enabled: true
      -
        id: ltg2xdow
        title: Camping
        image:
          - camping.jpg
        description:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                text: 'Camping is pretty awesome too.'
        type: tab_item
        enabled: true
      -
        id: mfoibox7
        title: Skiing
        image:
          - skiing.jpg
        type: tab_item
        enabled: true
        description:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                text: 'Skiing is cool, I guess.'
      -
        id: mfyhegai
        title: 'This one is just text'
        description:
          -
            type: paragraph
            content:
              -
                type: text
                text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.'
          -
            type: heading
            attrs:
              level: 4
            content:
              -
                type: text
                text: 'Inline Heading'
          -
            type: paragraph
            content:
              -
                type: text
                text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation. '
          -
            type: paragraph
            content:
              -
                type: text
                text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.'
        type: tab_item
        enabled: true
    type: tabs_explorer
    enabled: true
    theme: dark
    eyebrow_text: Explore
    description:
      -
        type: paragraph
        content:
          -
            type: text
            text: 'Use your arrow keys to navigate between tabs, and the tab key to focus to the next component.'
          -
            type: hardBreak
          -
            type: text
            text: 'Images are optional in the tabs. It could be just text if you want to!'
  -
    id: ltgg2024
    sections:
      -
        id: ltgg0afl
        orientation: left
        image:
          - camping.jpg
        heading: 'Sleep Under the Stars'
        type: section
        enabled: true
        description:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.'
        cta_text: 'Contact Us'
        entries_field: 726ad294-cf9c-40fd-b204-277118b5aed5
        cta_link: 726ad294-cf9c-40fd-b204-277118b5aed5
        eyebrow_text: Camping
        link_style: button
        link_to_external: false
        linked_entry: 6c6cc987-6958-4c55-a2d0-08ded8af0daf
        override_link_text: false
      -
        id: ltt0zyf7
        orientation: right
        image:
          - hiker.jpg
        heading: 'Explore the Trails'
        type: section
        enabled: true
        description:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.'
        cta_text: 'Contact Us'
        entries_field: 726ad294-cf9c-40fd-b204-277118b5aed5
        cta_link: 726ad294-cf9c-40fd-b204-277118b5aed5
        eyebrow_text: Hiking
        link_style: button
        link_to_external: false
        linked_entry: 29fa7ae7-8985-4e8b-b6d6-d47476033020
        override_link_text: false
      -
        id: mfrcey39
        orientation: left
        image:
          - skiing.jpg
        heading: 'Enjoy the Alpine Snow'
        type: section
        enabled: true
        description:
          -
            type: paragraph
            attrs:
              textAlign: left
            content:
              -
                type: text
                text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.'
        cta_text: 'Contact Us'
        entries_field: 726ad294-cf9c-40fd-b204-277118b5aed5
        cta_link: 726ad294-cf9c-40fd-b204-277118b5aed5
        eyebrow_text: Skiing
        link_style: button
        link_to_external: false
        linked_entry: aa04bb78-a9ca-4a66-8539-87849e850a65
        override_link_text: false
    type: fifty_split
    enabled: true
    theme: default
  -
    id: lt92fsja
    heading: 'Read Our Latest News'
    type: blog_teaser
    enabled: true
    theme: muted
    eyebrow_text: 'Recent Posts'
  -
    id: mfzmb4r5
    theme: light
    eyebrow_text: People
    heading: 'Meet Our Team'
    description:
      -
        type: paragraph
        content:
          -
            type: text
            text: 'Our dynamic team of practitioners are super able to do the things they claim to do, and more.'
    team_members:
      - a11e131d-fec5-465b-b6aa-7f8eeb329c64
      - a3431075-ed07-448f-8097-2e1ecda20e60
    type: team_members
    enabled: true
  -
    id: mfpmd7ot
    theme: dark
    type: image_callout
    enabled: true
    heading: 'Get to know the Pacific Northwest'
    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
    link_style: ghost
    link_to_external: false
    background_image: hiker.jpg
    eyebrow_text: Discover
    linked_entry: 726ad294-cf9c-40fd-b204-277118b5aed5
    override_link_text: false
  -
    id: malldcwi
    callout_item:
      -
        id: dV62P48B
        grid_headline: 'An Important Point'
        grid_content:
          -
            type: paragraph
            content:
              -
                type: text
                text: "This is a super important point that you should consider. Isn't the icon convincing?"
        grid_image: noun_tree_2.png
      -
        id: 9jtJ2Nv3
        grid_headline: 'Another Good Point'
        grid_content:
          -
            type: paragraph
            content:
              -
                type: text
                text: "Same goes for this one. Isn't this icon "
              -
                type: text
                marks:
                  -
                    type: italic
                text: also
              -
                type: text
                text: ' convincing?'
        grid_image: noun_tree_3.png
      -
        id: mb017zme
        grid_headline: 'A Third Good Point'
        grid_content:
          -
            type: paragraph
            content:
              -
                type: text
                text: "Same goes for this one. Isn't this icon "
              -
                type: text
                marks:
                  -
                    type: italic
                text: also
              -
                type: text
                text: ' convincing?'
        grid_image: noun_tree_4.png
      -
        id: mb01816c
        grid_headline: 'A Final Good Point'
        grid_content:
          -
            type: paragraph
            content:
              -
                type: text
                text: "Same goes for this one. Isn't this icon "
              -
                type: text
                marks:
                  -
                    type: italic
                text: also
              -
                type: text
                text: ' convincing?'
        grid_image: noun_tree.png
    type: callout_grid
    enabled: true
    theme: muted
  -
    id: ltgfpcib
    heading: 'See some pretty things'
    images:
      - camping.jpg
      - hiker.jpg
      - skiing.jpg
    auto_play: true
    show_index: false
    type: image_carousel
    enabled: true
    theme: default
    items_to_show: 1
    eyebrow_text: 'Soak it up'
  -
    id: lt9388pv
    heading: FAQs
    accordion_group:
      -
        id: lt938dpy
        heading: Hiking
        content:
          -
            type: paragraph
            content:
              -
                type: text
                text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Purus gravida quis blandit turpis cursus in. Accumsan tortor posuere ac ut consequat semper. '
        type: accordion_group
        enabled: true
      -
        id: lt9395dr
        heading: Skiing
        content:
          -
            type: paragraph
            content:
              -
                type: text
                text: 'Velit sed ullamcorper morbi tincidunt ornare massa. Lorem ipsum dolor sit amet consectetur adipiscing elit. Varius sit amet mattis vulputate. Enim nulla aliquet porttitor lacus luctus accumsan tortor. Vel facilisis volutpat est velit egestas dui id. Tristique risus nec feugiat in fermentum.'
        type: accordion_group
        enabled: true
      -
        id: lt939cp5
        heading: Camping
        content:
          -
            type: paragraph
            content:
              -
                type: text
                text: 'Aliquam sem fringilla ut morbi tincidunt augue. Augue neque gravida in fermentum et sollicitudin ac orci phasellus. Ante metus dictum at tempor commodo ullamcorper a lacus. Eu volutpat odio facilisis mauris sit. Velit aliquet sagittis id consectetur purus ut. Auctor elit sed vulputate mi sit amet mauris.'
        type: accordion_group
        enabled: true
    type: accordion
    enabled: true
    theme: muted
    description:
      -
        type: paragraph
        content:
          -
            type: text
            text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
    eyebrow_text: Learn
  -
    id: lvgwz0kp
    cta_heading: 'Book Your Adventure Now'
    short_description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
    type: cta_bumper
    enabled: true
    cta_link: 96920a7d-9b68-47c6-ad50-fe8906b8c6ab
    cta_text: 'Get started'
    theme: accent
    eyebrow_text: 'Get in Touch'
    link_style: button
    link_to_external: false
    linked_entry: 726ad294-cf9c-40fd-b204-277118b5aed5
    override_link_text: false
main_header_style: transparent
show_page_title: false
meta_title: 'Cascadia Starter Kit'
meta_description: 'The Cascadia Starter Kit is a more-or-less un-opinionated starter for developers. Construct your site with ease using the Page Builder, with components that are easy to style according to your design.'
og_image:
  - cascadia-kit-og.jpg
---
