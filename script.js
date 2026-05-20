document.getElementById("search").addEventListener("keyup", function() {
    let query = this.value;

    fetch("search.php?q=" + query)
    .then(response => response.json())
    .then(data => {

        let output = "";

        data.forEach(event => {
            output += `
                <div class="event">
                    <h3>${event.title}</h3>
                    <p>${event.description}</p>
                    <p>${event.date}</p>
                    <p>${event.location}</p>
                    <p>${event.category}</p>
                </div>
            `;
        });

        document.getElementById("events").innerHTML = output;
    });
});