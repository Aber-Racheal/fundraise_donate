document.getElementById('donate-now"').addEventListener('click', () => {
    fetch('/check-auth', {
        method: 'GET',
        credentials: 'include', // Ensures cookies are sent with the request
    })
    .then(response => {
        if (response.ok) {
            // User is logged in, redirect to donate.html
            window.location.href = '/donate.html';
        } else {
            // User not logged in, redirect to signup page
            window.location.href = '/signup.html?redirect=donate.html';
        }
    })
    .catch(error => console.error('Error checking auth:', error));
});
