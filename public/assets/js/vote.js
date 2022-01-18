document.addEventListener('DOMContentLoaded', function () {
    const events = Array.from(document.querySelectorAll('.vote-card'));
    events
        .forEach(el => {
            el.addEventListener('click', function (e) {
                events.forEach(el => el.classList.remove('selected'));
                el.classList.add('selected');

                window.location.href = window.location.href.slice(0, window.location.href.indexOf("/vote")) + '/vote/' + el.getAttribute('data-id');
            }, false);
        });
});