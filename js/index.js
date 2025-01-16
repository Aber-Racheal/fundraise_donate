document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('start-fundraise').addEventListener('click', () => {
        fetch('php/check-auth.php', {
            method: 'GET',
            credentials: 'include',
        })
        .then(response => {
            if (response.ok) {
                window.location.href = '/fundraise.html';
            } else {
                window.location.href = '/signup.html?redirect=fundraise.html';
            }
        })
        .catch(error => console.error('Error checking auth:', error));
    });
});
