import './bootstrap';
document.addEventListener('DOMContentLoaded', function() {
    const signInLink = document.querySelector('#signInLink');
    const signUpLink = document.querySelector('#registerLink');
    const content1 = document.querySelector('.content1');
    const content2 = document.querySelector('.content2');

    signInLink.addEventListener('click', function(event) {
        event.preventDefault();
        content1.style.display = 'block';
        content2.style.display = 'none';
    });

    signUpLink.addEventListener('click', function(event) {
        event.preventDefault();
        content2.style.display = 'block';
        content1.style.display = 'none';
    });
});
