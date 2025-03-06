// OpenCage API key (replace with your actual key)
const apiKey = 'ea1905164d35443e83d812dff1a82fe8'; 

// Function to calculate the distance between two geographical points
function haversine(lat1, lon1, lat2, lon2) {
    const R = 6371; // Radius of the Earth in kilometers
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;
    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
              Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
              Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    const distance = R * c; // Distance in kilometers
    return distance;
}

// Check if the browser supports Geolocation
if ("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(function(position) {
        // Success callback: Get latitude and longitude
        const userLat = position.coords.latitude;
        const userLon = position.coords.longitude;

        // Get the faculty cards from the DOM
        const faculties = document.querySelectorAll('.faculty-card');
        
        const facultiesWithDistance = [];

        // Loop through each faculty and calculate the distance
        faculties.forEach(function(faculty) {
            const facultyLat = parseFloat(faculty.getAttribute('data-lat'));
            const facultyLon = parseFloat(faculty.getAttribute('data-lon'));


            // Calculate the distance between user and faculty
            const distance = haversine(userLat, userLon, facultyLat, facultyLon);

            // Add the faculty and its distance to the array
            facultiesWithDistance.push({
                element: faculty,
                distance: distance
            });
        });

        // Sort faculties by distance (ascending order)
        facultiesWithDistance.sort(function(a, b) {
            return a.distance - b.distance;
        });

        // Display only the top 3 closest faculties
        const facultiesList = document.getElementById("faculties-list");
        facultiesList.innerHTML = ''; // Clear current list

        const top3Faculties = facultiesWithDistance.slice(0, 3); // Get only the top 3 closest faculties

        top3Faculties.forEach(function(item) {
            facultiesList.appendChild(item.element);
        });

        // Display the closest faculty distance (optional)
        document.getElementById("location-info").innerHTML = 
            `Your current location is: Latitude: ${userLat}, Longitude: ${userLon}. Showing top 3 closest faculties.`;

    }, function(error) {
        document.getElementById("location-info").innerHTML = "Unable to retrieve your location.";
    });
} else {
    document.getElementById("location-info").innerHTML = "Geolocation is not supported by your browser.";
}
