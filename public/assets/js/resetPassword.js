function resetPassword() {
    const email = prompt('Quelle est votre adresse e-mail ?');
    if (email) {
        window.location.href = window.location.href.slice(0, window.location.href.indexOf('/signin')) + `/signin/resetPassword?email=${email}`;
    }
}