export default ({ showBar }) => ({
    init() {
        // set notification bar visibility based on localStorage
        const dismissed = localStorage.getItem('notificationBarDismissed') === 'true';
        this.notificationBarVisible = showBar && !dismissed;

        // Let Alpine fully mount, then enable transition
        this.$nextTick(() => {
            this.transitionEnabled = showBar;
        });
    },

    openMenuClass: 'open-menu',
    isMenuOpen: false,
    isModalOpen: false,
    showBar: false,
	lastScrollTop: 0,
    //modal
    isModalOpen: false,
    activeModal: null,

    // offcanvas
    isOffcanvasOpen: false,

    // notification bar
    transitionEnabled: false,
    notificationBarVisible: false,

    toggleModal(id) {
        if(this.isModalOpen) {
            this.closeModal(id)
        } else {
            this.openModal(id)
        }
    },

    toggleMenu() {
        this.isMenuOpen = this.isMenuOpen ? false : true;
    },

    closeMenu() {
        this.isMenuOpen = false
    },

    openMenu() {
        this.isMenuOpen = true
    },

    handleResize() {
        // console.log('resize')
        if (window.innerWidth >= 1024) {
            // console.log('resize > 1024')
            this.closeMenu()
        }
    },

    openModal(id) {
        this.isModalOpen = true;
        this.activeModal = this.isModalOpen ? id : null;

        window.dispatchEvent(
            new CustomEvent('modal-open', {
                detail: { id: this.activeModal },
            })
        );
    },

    closeModal() {
        this.isModalOpen = false;
        this.activeModal = null;

        window.dispatchEvent(
            new CustomEvent('modal-close')
        );
    },

    closeNotificationBar() {
        this.notificationBarVisible = false;
        localStorage.setItem('notificationBarDismissed', 'true');
    }
})
