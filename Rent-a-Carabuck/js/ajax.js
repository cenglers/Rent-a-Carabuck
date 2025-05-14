// Dinamik araç listesi çekme
function fetchCars() {
    fetch("ajax/getCars.php")
        .then(response => response.json())
        .then(cars => {
            const carList = document.querySelector("#carList");
            carList.innerHTML = ""; // Listeyi temizle

            cars.forEach(car => {
                const carDiv = document.createElement("div");
                carDiv.className = "car";
                carDiv.innerHTML = `
                    <h3>${car.name}</h3>
                    <p>${car.description}</p>
                    <p>Price: $${car.price} per day</p>
                    <img src="images/${car.image}" alt="${car.name}">
                    <button onclick="bookCar(${car.id})">Book Now</button>
                `;
                carList.appendChild(carDiv);
            });
        })
        .catch(error => console.error("Error fetching cars:", error));
}

// Araç rezervasyonu yapma
function bookCar(carId) {
    fetch("ajax/bookCar.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `car_id=${carId}`
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message); // Kullanıcıya mesaj göster

            if (data.status === "success") {
                fetchCars(); // Rezervasyondan sonra listeyi güncelle
            }
        })
        .catch(error => console.error("Error booking car:", error));
}

// Sayfa yüklendiğinde araç listesini otomatik olarak çek
document.addEventListener("DOMContentLoaded", function () {
    fetchCars();
});
