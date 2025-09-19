export default () => ({
    async init() {
        // console.log('google-map.js');
        this.initMap();
    },

    map: null,
    markers: [],
    locationFilter: 'All',
    locationFilters: [],
    listings: [],
    filteredListings: [],

    getListings() {
        const listings = window.locationsOfInterest || [];
        this.listings = listings;
        return listings;
    },

    filterMarkers() {
        const map = Alpine.raw(this.map);
        const filteredListings = [];

        this.markers.forEach(item => {
            if(this.locationFilter == 'All' || item.locationType == this.locationFilter) {
                item.map = map;
                const listing = this.listings.find(listing => listing.name === item.title);
                filteredListings.push(listing);
            } else {
                item.map = null
            }
        })

        // errors will be thrown if there are no markers
        if (!this.markers.length) {
            console.warn('No markers to filter — skipping bounds adjustment.');
            return;
        }

        // set new map bounds after
        // filtering the markers
        const bounds = this.getBuildingBounds(filteredListings);
        this.setMapSize(bounds, map)

    },

    async initMap() {
		let map;
		let mapEl = this.$refs.map;

        // if you import styles from a file, you can use this
		// console.log('here', MAP_STYLES)

		if( google && mapEl ) {
            // see https://developers.google.com/maps/documentation/javascript/overview#javascript
            const { Map } = await google.maps.importLibrary("maps");
			map = new Map( mapEl, {
				center: { lat: 49.24, lng: -123.1256 },
				zoom: 8,
                minZoom: 8,
                maxZoom: 14,
                // mapId: '82f1ef3936f63a29',
                mapId: 'DEMO_MAP_ID',
				// scrollwheel: false,
				scaleControl: true,
				// styles: MAP_STYLES,
				// streetViewControlOptions: true,
			});

            this.map = map;
			const listings = this.getListings();

            map.setZoom(15);

			if( listings && listings.length ) {
                await this.setMarkers({ map });
                this.filterMarkers();
			}

			/**
			 * handles the edge case where if a map isn't visible
			 * on load, it won't set its size to the bounds
			 */
			document.body.addEventListener('set-map-view', () => {
                setTimeout(() => {
                    const bounds = this.getBuildingBounds(this.filteredListings.length ? this.filteredListings : this.listings);
                    this.setMapSize(bounds, map);
                }, 0);
            }, false);
		}


	},

    setMapSize(bounds, map){
        if( this.listings.length > 1) {
            // has side effects
            map.fitBounds( bounds );
            this.handleBoundsOnResize({ bounds, map })
        }
    },

    focusLocation(e) {
        const { dataset } = e.target;
        const marker = this.markers.find(m => m.title === dataset.name); // Find marker by ID

        if (marker) {
            google.maps.event.trigger(marker, 'gmp-click');
        }
    },

    async setMarkers({ map }) {
        const { AdvancedMarkerElement, PinElement } = await google.maps.importLibrary("marker");
        const { InfoWindow } = await google.maps.importLibrary("maps");

        // Create an info window to share between markers.
        const infoWindow = new InfoWindow();

        this.markers = this.listings.map(location => {

            /**
             * Style Pin Elements here:
             * https://developers.google.com/maps/documentation/javascript/advanced-markers/basic-customization
             */
            const customPin = new PinElement({ glyphColor: "white" });


             /**
             * Use a custom graphic or SVG here:
             * https://developers.google.com/maps/documentation/javascript/advanced-markers/graphic-markers
             */
            const marker = new AdvancedMarkerElement({
                map,
                title: location.name,
                position: {
                    lat: parseFloat(location.latitude),
                    lng: parseFloat(location.longitude),
                },
                content: customPin.element,
            });

             // Set category property using set method
            marker.locationType = location.location_type.title;

            /**
             * Interactive Markers Here:
             * https://developers.google.com/maps/documentation/javascript/advanced-markers/html-markers#interactive_markers
             */

            /**
             * This method gets invoked when a
             * marker click is triggered
             */
            marker.addListener('gmp-click', () => {
                infoWindow.close();
                infoWindow.setContent(marker.title);
                infoWindow.open(marker.map, marker);
                map.panTo(marker.position);
            });

            return marker;
        });


        return Promise.resolve(this.markers);
	},

	getBuildingBounds(listings) {
		const lats = listings.map(listing => parseFloat(listing.latitude))
		const lngs = listings.map(listing => parseFloat(listing.longitude))

		return {
			north: Math.max(...lats),
			south: Math.min(...lats),
			east: Math.max(...lngs),
			west: Math.min(...lngs)
		}
	},

	handleBoundsOnResize({ bounds, map }){
		// apply fit bounds on window resize event
		map.addListener('idle', () => {
			this.mapIdleHandler({ bounds, map })
		});
	},

	mapIdleHandler({ bounds, map }) {
		window.addEventListener('resize', () => {
			map.fitBounds(bounds);

			// if( !checkIsDesktop() ){
			// 	Alpine.store('mapData').setBuilding(null);
			// 	Alpine.store('mapData').infobox.close();
			// }
		})
	},

    setLocationFilter( value ) {
        this.locationFilter = value;
        this.filterMarkers()
    }

});
