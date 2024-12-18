function searchFunction() {
    var searchTerm = document.getElementById("search").value;

    // Check if the search term is not empty
    if (searchTerm.trim() !== '') {
        $.ajax({
            type: "POST",
            url: "../Database/search.php",
            data: {
                searchTerm: searchTerm
            },
            dataType: "json",
            success: function(response) {
                if (response.length > 0) {
                    
                // Encode the search results as a URL parameter
                var searchResultsParam = encodeURIComponent(JSON.stringify(response));
                
                // Redirect to the livesearch.php page with the search results as a parameter
                window.location.href = "../html/livesearch.php?searchResults=" + searchResultsParam;
                } else {
                    // Display message indicating no results found
                    alert("No results found.");
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    } else {
        // Do something when the search term is empty, like showing an error message or simply ignoring
        alert("Search is empty");
    }
}
