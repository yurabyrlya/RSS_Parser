
const addClickWithAltKeYToItem = () =>{
    const items = document.querySelectorAll('.table-row');
    items.forEach(item => item.addEventListener('click', (event) => {
        if (!event.altKey) {
            return;
        }
        event.stopPropagation();
        console.log('Alt key event');
        const el = event.target;
        // get data link
        const linkId = el.dataset?.id || el.parentElement.dataset.id ;
        console.log(el);
        if (!linkId) {
            console.error('failed to find data link');
            return;
        }
        toggleLink(linkId)

    }));
};

const toggleLink = (id) => {
    const link = document.getElementById(id);
    removeActiveLinks()
    link.classList.remove('hide');
}

const removeActiveLinks = () => {
    document.querySelectorAll('.data-link').forEach((item) => {
        item.classList.add('hide');
    });
}

window.onclick = (event) => {
    removeActiveLinks();
};
const run = () => {
    addClickWithAltKeYToItem();
};
window.onload = run;