Array.from(document.querySelectorAll('.numbers-only')).forEach(el => el.addEventListener('keydown', e => {
    if (!e.key.match(/^[0-9]/g) && e.keyCode !== 8 && e.keyCode !== 46) {
        e.preventDefault();
    }
}));

function newUnlockableContent() {
    const ul = document.getElementById('addUnlockableContent');

    const li = ul.firstElementChild.cloneNode(true);
    li.style.display = 'block';

    ul.appendChild(li);

}

function submit() {
    console.log('submitting..');
    document.querySelector('ul').children[0].remove();
    return true;
}