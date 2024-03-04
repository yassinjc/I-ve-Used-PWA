<template>
    <div class="map">
        <div ref="map"></div>
        <!-- :class="{ 'popup__overlay--active': manual || popup }" @click.prevent="() => { popup = false; manual = false; }" -->
        <popup :active="manual">
            <!-- Manual popup content -->
            <h1 class="map__title h3">Gebruikershandleiding</h1>

            <div class="map__instructions">
                <div class="map__instruction">
                    <svg width="30" height="30" viewBox="0 0 30 30"> <path id="Icon_material-zoom-out" data-name="Icon material-zoom-out" d="M25.941,23.368H24.586l-.48-.463a11.166,11.166,0,1,0-1.2,1.2l.463.48v1.355L31.944,34.5,34.5,31.944Zm-10.292,0a7.719,7.719,0,1,1,7.719-7.719A7.708,7.708,0,0,1,15.649,23.368Zm-4.288-8.576h8.576v1.715H11.361Z" transform="translate(-4.5 -4.5)" fill="#a5a5a5"/> </svg>
                    <p>Spreid je vingers over het scherm om in te zoomen</p>
                </div>

                <div class="map__instruction">
                    <svg width="27" height="36" viewBox="0 0 27 36"><g transform="translate(-146 -363)"><circle cx="8" cy="8" r="8" transform="translate(151 368)" fill="#fff"/><path d="M12.113,35.274C1.9,20.463,0,18.943,0,13.5a13.5,13.5,0,0,1,27,0c0,5.443-1.9,6.963-12.113,21.774a1.688,1.688,0,0,1-2.775,0ZM13.5,19.125A5.625,5.625,0,1,0,7.875,13.5,5.625,5.625,0,0,0,13.5,19.125Z" transform="translate(146 363)" fill="#49bcf9"/></g></svg>
                    <p>Klik op een blauwe marker om meer informatie te zien over een ongeval</p>
                </div>

                <div class="map__instruction">
                    <svg width="20" height="20" viewBox="0 0 20 20"> <path id="Icon_metro-cross" data-name="Icon metro-cross" d="M22.388,18h0l-6.067-6.067,6.067-6.067h0a.626.626,0,0,0,0-.884L19.522,2.111a.627.627,0,0,0-.884,0h0L12.571,8.178,6.5,2.111h0a.627.627,0,0,0-.884,0L2.753,4.977a.626.626,0,0,0,0,.884h0l6.067,6.067L2.753,18h0a.626.626,0,0,0,0,.884L5.62,21.745a.626.626,0,0,0,.884,0h0l6.067-6.067,6.067,6.067h0a.626.626,0,0,0,.884,0l2.866-2.866a.626.626,0,0,0,0-.884Z" transform="translate(-2.571 -1.928)" fill="#a5a5a5"/> </svg>
                    <p>Sluit de desbetreffende popup door op het kruisje te klikken</p>
                </div>
            </div>

            <a class="btn" @click.prevent="manual = false;">Ik begrijp het</a>
        </popup>

        <popup :active="popup">
            <!-- Accident popup content -->
            <div class="popup--inner">
                <a href="#" class="map__cross" @click.prevent="() => { popup = false; }">
                    <svg width="20" height="20" viewBox="0 0 20 20"> <path id="Icon_metro-cross" data-name="Icon metro-cross" d="M22.388,18h0l-6.067-6.067,6.067-6.067h0a.626.626,0,0,0,0-.884L19.522,2.111a.627.627,0,0,0-.884,0h0L12.571,8.178,6.5,2.111h0a.627.627,0,0,0-.884,0L2.753,4.977a.626.626,0,0,0,0,.884h0l6.067,6.067L2.753,18h0a.626.626,0,0,0,0,.884L5.62,21.745a.626.626,0,0,0,.884,0h0l6.067-6.067,6.067,6.067h0a.626.626,0,0,0,.884,0l2.866-2.866a.626.626,0,0,0,0-.884Z" transform="translate(-2.571 -1.928)" fill="#a5a5a5"/> </svg>
                </a>

                <h2 class="h3">{{ activePopup.title }}</h2>

                <div class="map__labels">
                    <a class="map__label" href="#" v-for="(label, index) in activePopup.labels" :key="index">{{label}}</a>
                </div>

                <img class="map__image" :src="activePopup.image" alt="">

                <p class="map__paragraph">{{ activePopup.paragraph }}</p>
            </div>
        </popup>
    </div>
</template>

<script>
    // Import the leaflet library with accessory CSS
    import leaflet from 'leaflet';
    import 'leaflet/dist/leaflet.css';

    // Import popup component
    import popup from './popup.vue'

    export default {
        data () {
            return {
                // accidents: JSON.parse(this.$props.accidents),
                manual: true,
                popup: false,
                activePopup: this.$props.accidents[0]
            }
        },
        components: {
            popup: popup
        },
        props: ['accidents'],
        mounted () {
            // Get the map element
            var mapElement = this.$refs.map;
            const eindhovenLatLng = [51.44083, 5.47778];
            const markerIcon = L.icon({
                iconSize: [30, 48],
                iconAnchor: [16, 55],
                popupAnchor: [0, -65],
                iconUrl: './dist/img/icons/map-marker-icon.svg'
            });

            // Let the map take up all available height
            mapElement.style.height = document.getElementsByClassName("map__wrapper")[0].offsetHeight + "px";

            // Initialze the Leaflet map with the latitude and longitude from Eindhoven
            var leafletMap = leaflet.map(mapElement).setView(eindhovenLatLng, 11);

            // Add tile-layer to leaflet map (load location images)
            leaflet.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png').addTo(leafletMap);

            // Loop troug accidents and add markers to map
            this.$props.accidents.forEach(accident => {
                
                // Save markerlocation for later use
                const markerLocation = [accident.latitude, accident.longitude];

                // Add custom marker to map
                leaflet.marker(markerLocation, {icon: markerIcon}).addTo(leafletMap).on('click', (e) => {
                    this.popup = true;
                    leafletMap.setView(e.target.getLatLng(), 11);

                    // Change popup information to custom popup
                    this.activePopup = accident;

                    // Find the pixel location on the map where the popup anchor is
                    var px = leafletMap.project(markerLocation);

                    // Find the height of the map, divide by 2 to centre, subtract from the Y axis of marker location
                    px.y -= mapElement.clientHeight / 3;

                    // Pan to marker center
                    leafletMap.panTo(leafletMap.unproject(px), {animate: true});
                });
            });
        }
    }
</script>

<style lang="sass">
    // Make the colers of the tiles in the map better match our designed UI
    .leaflet-tile 
        filter: grayscale(0.25) !important

    // Hide original cancel-button for marker popup
    .leaflet-popup-close-button
        display: none

    // Hide the attribution to Leaflet that is positioned over the map
    .leaflet-control-attribution
        display: none

    // Hide control container over Leaflet Map
    .leaflet-control-container
        display: none
</style>