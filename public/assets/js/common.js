$( document ).ready(function() {
    $('#clear-search-button').click(function() {
        // Get the current URL
        var currentUrl = window.location.href;

        // Remove the query parameters from the URL
        var baseUrl = currentUrl.split('?')[0];

        // Reload the page to the base URL
        window.location.href = baseUrl;
    });
});
