export default () => ({
    activeItem: 0,

    handleKeydown(event) {
        const tabs = Array.from(this.$refs.tablist.querySelectorAll('[role=tab]'));
        const currentIndex = tabs.indexOf(event.target);

        switch (event.key) {
            case 'ArrowDown':
            case 'ArrowRight':
                event.preventDefault();
                const nextIndex = (currentIndex + 1) % tabs.length;
                tabs[nextIndex].focus();
                this.activeItem = nextIndex;
                break;
            case 'ArrowUp':
            case 'ArrowLeft':
                event.preventDefault();
                const prevIndex = currentIndex === 0 ? tabs.length - 1 : currentIndex - 1;
                tabs[prevIndex].focus();
                this.activeItem = prevIndex;
                break;
            case 'Home':
                event.preventDefault();
                tabs[0].focus();
                this.activeItem = 0;
                break;
            case 'End':
                event.preventDefault();
                const lastIndex = tabs.length - 1;
                tabs[lastIndex].focus();
                this.activeItem = lastIndex;
                break;
        }
    }
});
