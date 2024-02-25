<?php

require "connection/connection.php";

if (!isset($_SESSION['user'])) {
    header("location: home.php");
    die();
} else {
    $welcome =  'Welcome to Student Application Section <span><i class="far fa-edit "></i></span>';
    // Fetch today's date
    $today = date("Y-m-d");

    // Fetch booked slots for today's date and the selected venue
    $sqlAuditorium = "SELECT * FROM Booked WHERE date >= '$today' AND venue_id = 1";
    $resultAuditorium = $connection->query($sqlAuditorium);

    $sqlTurf = "SELECT * FROM Booked WHERE date >= '$today' AND venue_id = 2";
    $resultTurf = $connection->query($sqlTurf);


    // Store booked slots for each venue in separate arrays
    $bookedSlotsAuditorium = array();
    if ($resultAuditorium->num_rows > 0) {
        while ($row = $resultAuditorium->fetch_assoc()) {
            $bookedSlotsAuditorium[$row['date']][] = $row['time_slot'];
        }
    }

    $bookedSlotsTurf = array();
    if ($resultTurf->num_rows > 0) {
        while ($row = $resultTurf->fetch_assoc()) {
            $bookedSlotsTurf[$row['date']][] = $row['time_slot'];
        }
    }

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap');
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        body {
            background-image: url('bgevent.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            color: #333;
        }
        .heading {
            margin-top: 10px;
            text-align: center;
            font-family: 'Montserrat', sans-serif;
            font-size: 700;
        }
        .heading-container {
          background-color: #e1daa599; 
            padding: 20px;
        }

        h1 {
            text-align: center;
        }
        .event-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .event {
            text-align: center;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 45%;
        }
        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
    

        table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
    color: #fff; 
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
    font-size: 18px; 
}


th {
    background-color: #333;
}


tr:nth-child(odd) {
    background-color: #666;
}


tr:nth-child(even) {
    background-color: #999;
}

.event img {
    max-width: 70%;
    height: auto;
    border-radius: 8px;
    transition: filter 0.3s ease-in-out, box-shadow 0.3s ease-in-out; 
}

.event img:hover {
    filter: brightness(80%); 
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

.logout-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999; /* Ensure the button appears on top of other elements */
            background-color: #dc3545; /* Bootstrap danger color */
            color: #fff; /* Text color */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
      
    </style>
</head>
<body>
<button class="logout-btn" id="logoutButton">Log Out</button>
    <div class="container-fluid">
        <div class="heading-container">
                    <h1 class="heading">Upcoming Events</h1>
                </div>

<div class="event-container">
    <div class="event" onclick="showEventDetails('Turf Event', '2024-03-10', '3:00 PM - 5:00 PM')">
        <img src="turf.jpg" alt="Turf Event">
        <h2>Turf Event</h2>
    </div>

    <div class="event" onclick="showEventDetails('Auditorium Event', '2024-03-15', '7:00 PM - 9:00 PM')">
        <img src="auditorium.jpg" alt="Auditorium Event">
        <h2>Auditorium Event</h2>
    </div>
</div>

<div id="eventDetails"></div>

<script>
        // Define your booked slots data
        var bookedSlotsAuditorium = <?php echo json_encode($bookedSlotsAuditorium); ?>;
        var bookedSlotsTurf = <?php echo json_encode($bookedSlotsTurf); ?>;

        function showEventDetails(eventName, eventDate, eventTime) {
            var eventDetailsContainer = document.getElementById('eventDetails');
            eventDetailsContainer.innerHTML = '';

            var detailsTable = document.createElement('table');
            var headerRow = detailsTable.insertRow(0);
            var eventTypeHeader = headerRow.insertCell(0);
            var eventDateHeader = headerRow.insertCell(1);
            var eventTimeHeader = headerRow.insertCell(2);

            eventTypeHeader.textContent = 'Event';
            eventDateHeader.textContent = 'Date';
            eventTimeHeader.textContent = 'Time';

            // Populate table for Auditorium
            if (eventName === 'Auditorium Event') {
                for (var date in bookedSlotsAuditorium) {
                    bookedSlotsAuditorium[date].forEach(function(timeSlot) {
                        var row = detailsTable.insertRow();
                        var eventTypeCell = row.insertCell(0);
                        var dateCell = row.insertCell(1);
                        var timeCell = row.insertCell(2);

                        eventTypeCell.textContent = 'Audi Event';
                        dateCell.textContent = date;
                        timeCell.textContent = timeSlot;
                    });
                }
            }

            // Populate table for Turf
            if (eventName === 'Turf Event') {
                for (var date in bookedSlotsTurf) {
                    bookedSlotsTurf[date].forEach(function(timeSlot) {
                        var row = detailsTable.insertRow();
                        var eventTypeCell = row.insertCell(0);
                        var dateCell = row.insertCell(1);
                        var timeCell = row.insertCell(2);

                        eventTypeCell.textContent = 'Turf Event';
                        dateCell.textContent = date;
                        timeCell.textContent = timeSlot;
                    });
                }
            }

            eventDetailsContainer.appendChild(detailsTable);
        }

        // LogOut 
        const logoutButton = document.getElementById('logoutButton');

        logoutButton.addEventListener('click', function() {
            // Redirect to logout.php
            window.location.href = 'logout.php';
        });
    </script>
</body>
</html>