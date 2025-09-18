---
id: home
blueprint: pages
title: Home
template: home
author: b3154f8e-5ed4-4804-a31c-5b768efc6e8e
updated_by: b3154f8e-5ed4-4804-a31c-5b768efc6e8e
updated_at: 1758218102
page_builder:
  -
    id: ltgcaf0k
    main_heading: 'Cascadia Starter'
    sub_heading: 'A Starter Kit for Statamic, featuring TailwindCSS and AlpineJS'
    type: hero
    enabled: true
    cta_link: 96920a7d-9b68-47c6-ad50-fe8906b8c6ab
    cta_text: 'Learn More'
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
    heading: 'Welcome to the starter kit that is so awesome'
    intro_text:
      -
        type: paragraph
        content:
          -
            type: text
            text: 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.'
    intro_layout: horizontal
    type: intro
    enabled: true
    theme: accent
    link_style: button
    linked_entry: 96920a7d-9b68-47c6-ad50-fe8906b8c6ab
    link_to_external: false
  -
    id: ltg2wqkz
    heading: 'Discover Wilderness'
    tab_items:
      -
        id: ltg2wwy6
        title: Hiking
        image:
          - under-city-iron-bridge.jpeg
          - hiker.jpg
        description: 'This is a truly awesome thing'
        type: tab_item
        enabled: true
      -
        id: ltg2xdow
        title: Camping
        image:
          - urban-street-in-morning.jpeg
          - camping.jpg
        description: 'This is also a truly awesome thing'
        type: tab_item
        enabled: true
      -
        id: mfoibox7
        title: Skiing
        image:
          - skiing.jpg
        type: tab_item
        enabled: true
    type: tabs_explorer
    enabled: true
    theme: default
    eyebrow_text: Explore
  -
    id: lt92fsja
    heading: 'Recent Posts'
    type: blog_teaser
    enabled: true
    theme: default
  -
    id: mfpmd7ot
    theme: dark
    type: image_callout
    enabled: true
    heading: 'Get to know the Pacific Northwest'
    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
    link_style: link
    link_to_external: false
    background_image: hiker.jpg
    eyebrow_text: Discover
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
      -
        id: mb017zme
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
      -
        id: mb01816c
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
    type: callout_grid
    enabled: true
    theme: muted
  -
    id: ltgfpcib
    heading: 'See some pretty things'
    images:
      - camping.jpg
      - hiker.jpg
      - shadows-touching-ancient-stone.jpeg
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
    cta_heading: 'This is the CTA Heading.'
    short_description: 'This is the sort description text to complement the heading above.'
    type: cta_bumper
    enabled: true
    cta_link: 96920a7d-9b68-47c6-ad50-fe8906b8c6ab
    cta_text: 'Get started'
    theme: accent
main_header_style: transparent
show_page_title: false
---
