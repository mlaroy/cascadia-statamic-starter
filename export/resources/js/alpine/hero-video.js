import Player from '@vimeo/player';

export default ({ videoId, source }) => ({
    player: null,
    isPlaying: false,
    isPlayerReady: false,
    source: null,
    ytPlayerReady: false,
    videoId: null,
    wasPlayinOnModalOpen: false,

    init() {
        if( !videoId ) {
            console.warn("No video ID provided.");
            return;
        }
        this.videoId = videoId;
        this.source = source;

        switch (source) {
            case 'vimeo':
                this.initVimeoPlayer(videoId);
                break;
            case 'youtube':
                this.initYoutubePlayer(videoId);
                break;
            case 'asset':
                this.initFilePlayer(videoId);
                break;
            default:
                console.warn("Unsupported video source:", source);
                break;
        }

       // add custom event listener for modal-open/close
        window.addEventListener('modal-open', (event) => {
            this.wasPlayinOnModalOpen = this.isPlaying;
            this.pauseVideo();
        });
        window.addEventListener('modal-close', (event) => {
            if (this.wasPlayinOnModalOpen) {
                this.playVideo();
            }
        });
    },

    initVimeoPlayer(videoId) {
        const options = {
            id: videoId,
            loop: true,
            autoplay: true,
            muted: true,
            controls: false,
        }

        // Initialize Vimeo Player
        this.player = new Player('player', options);
        const $player =  Alpine.raw(this.player);


        // Event listeners for play, pause, and ended
        $player.on('play', () => {
            this.isPlaying = true;
            this.isPlayerReady = true;
        });

        this.player.on('pause', () => {
            this.isPlaying = false;
        });
    },

    initYoutubePlayer() {
        window.onYouTubeIframeAPIReady = () => {
            this.player = new YT.Player('youtube-player', {
                videoId: videoId,
                playerVars: {
                    autoplay: 1,
                    mute: 1,
                    controls: 0,
                    loop: 1,
                    playlist: videoId, // required for loop
                    modestbranding: 1,
                    rel: 0,
                    showinfo: 0,
                },
                events: {
                    onReady: (event) => {
                        this.isPlayerReady = true;
                        this.isPlaying = true;
                        event.target.playVideo();
                    },
                    onStateChange: (event) => {
                        const state = event.data;
                        this.isPlaying = state === YT.PlayerState.PLAYING;
                    }
                }
            });
        };
    },

    initFilePlayer() {
        const video = this.$refs.video;

        if (!video) {
            console.warn("Video element not found.");
            return;
        }

        this.player = video;
        this.player.muted = true;
        this.player.autoplay = true;
        this.player.loop = true;

        this.player.addEventListener('loadeddata', () => {
            this.isPlayerReady = true;
            this.isPlaying = !this.player.paused;
        });

        this.player.addEventListener('play', () => {
            this.isPlaying = true;
        });

        this.player.addEventListener('pause', () => {
            this.isPlaying = false;
        });
    },

    pauseVideo() {
        const $player =  Alpine.raw(this.player);

        if (!this.isPlayerReady || !$player) {
            console.warn('Player not ready yet.');
            return;
        }

        if (this.source === 'vimeo') {
            $player.pause().then(() => {
                this.isPlaying = false;
            }).catch(error => {
                console.error("Error pausing video:", error);
            });
        }

        if (this.source === 'youtube') {
            this.player.pauseVideo();
        }

        if (this.source === 'asset') {
            this.player.pause();
            this.isPlaying = false;
        }
    },

    playVideo() {
        const $player = Alpine.raw(this.player);

        if (!this.isPlayerReady || !$player) {
            console.warn('Player not ready yet.');
            return;
        }

        if (this.source === 'vimeo') {
            $player.play().then(() => {
                this.isPlaying = true;
            }).catch(error => {
                console.error("Error playing video:", error);
            });
        }

        if (this.source === 'youtube') {
            this.player.playVideo();
            this.isPlaying = true;
        }

        if (this.source === 'asset') {
            this.player.play();
            this.isPlaying = true;
        }
    },


    toggleVideo() {
        const $player =  Alpine.raw(this.player);

        if (!this.isPlayerReady || !$player) {
            console.warn('Player not ready yet.');
            return;
        }

        if (this.source === 'vimeo') {
            if (this.isPlaying) {
                $player.pause().then(() => {
                    this.isPlaying = false;
                }).catch(error => {
                    console.error("Error pausing video:", error);
                });
            } else {
                $player.play().then(() => {
                    this.isPlaying = true;
                }).catch(error => {
                    console.error("Error playing video:", error);
                });
            }
        }

        if (this.source === 'youtube') {
            const state = this.player.getPlayerState();
            if (state === YT.PlayerState.PLAYING) {
                this.player.pauseVideo();
            } else {
                this.player.playVideo();
            }
        }

        if (this.source === 'asset') {
            if (this.player.paused) {
                this.player.play();
                this.isPlaying = true;
            } else {
                this.player.pause();
                this.isPlaying = false;
            }
        }

    }
});
