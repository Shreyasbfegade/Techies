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

    $sqlPlayground = "SELECT * FROM Booked WHERE date >= '$today' AND venue_id = 3";
    $resultPlayground = $connection->query($sqlPlayground);

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

    $bookedSlotsPlayground = array();
    if ($resultPlayground->num_rows > 0) {
        while ($row = $resultPlayground->fetch_assoc()) {
            $bookedSlotsPlayground[$row['date']][] = $row['time_slot'];
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        h5 {
            padding-left: 200px !important;
        }

        .Wel {
            margin-left: 250px !important;
        }

        .size {
            font-size: 20px !important;
        }

        .container {
            margin: 50px 0px auto 150px;
            width: 1050px;
            max-width: 800px;
        }

        .gradient-custom {
            background: #f6d365 !important;
            background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1)) !important;
            background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1)) !important;
        }
    </style>

</head>

<body>

<?php include 'nav2.php'; ?>

    <div class="container-fluid ">
        <div class="row flex-nowrap">
        <?php include 'sidebar.php'; ?>
            <div class="col py-3" style="background-color: #dadada;">
                <div class="container">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-primary" style="height: 530px; width: 800px;"> 
                            <div class="panel-heading">
                                <h5>Please Fill the Application Form Below </h5>
                            </div>
                            <div style="padding: 10px;">
                                <form action="postaddfile.php" method="post" autocomplete="off" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label for="file_id">File ID</label>
                                        <input type="text" required="required" name="file_id" class="form-control opa" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="file_name">File Name</label>
                                        <input type="text" name="file_name" required="required" class="form-control opa" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="description">File Description (Optional)</label>
                                        <textarea name="description" class="form-control opa" rows="1"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="fileupload">Soft File (Optional)</label>
                                        <input type="file" name="fileupload" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                    <label for="date">Date: </label>
                                    <input type="date" name="date" id="date" class="form-control opa">
                                    </div>
                                    <div class="form-group">
                                    <label for="venue">Venue </label>
                                    <select id="venue" class="form-control opa" name="venue">
                                        <option value="" disabled selected>Select Venue</option>
                                        <option value="auditorium">Auditorium</option>
                                        <option value="turf">Turf</option>
                                        <option value="CollegeGround">CollegeGround</option>
                                    </select>
                                    </div>   
                                    <div class="form-group">
                                    <label for="freeSlots">Avialable Slots</label>
                                    <select id='freeSlots' class="form-control opa" name="freeSlots" multiple>
                                    <option value="" disabled selected>Select Timeslot</option>
                                    </select>
                                    </div> <br>   
                                    <input type="submit" class="btn btn-block btn-success " style="margin-left:275px; width: 230px;" value="Submit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    // Get today's date
    var today = new Date();

    // Get the input field for the date
    var dateInput = document.getElementById("date");

    // Set the minimum date for the input field to today's date
    dateInput.min = today.toISOString().split('T')[0];

    // PHP variables for booked slots
    var bookedSlotsAuditorium = <?php echo json_encode($bookedSlotsAuditorium); ?>;
    var bookedSlotsTurf = <?php echo json_encode($bookedSlotsTurf); ?>;
    var bookedSlotsPlayground = <?php echo json_encode($bookedSlotsPlayground); ?>;

    function updateFreeSlots() {
        var selectedDate = document.getElementById("date").value;
        var venue = document.getElementById("venue").value;

        if (selectedDate) {
            var allSlots = [
                "9.00-10.00",
                "10.00-11.00",
                "11.00-12.00",
                "12.00-13.00",
                "13.00-14.00",
                "14.00-15.00",
                "15.00-16.00",
                "16.00-17.00"
            ];

            var freeSlots = [];

            // Filter out booked slots based on the selected date and venue
            var bookedSlots = [];
            if (venue === "auditorium") {
                bookedSlots = bookedSlotsAuditorium[selectedDate] || [];
            } else if (venue === "turf") {
                bookedSlots = bookedSlotsTurf[selectedDate] || [];
            } else if (venue === "CollegeGround") {
                bookedSlots = bookedSlotsPlayground[selectedDate] || [];
            }

            freeSlots = allSlots.filter(function(slot) {
                return !bookedSlots.includes(slot);
            });

            // Update the dropdown options for free slots
            var freeSlotsDropdown = document.getElementById("freeSlots");
            freeSlotsDropdown.innerHTML = "";
            freeSlots.forEach(function(slot) {
                var option = document.createElement("option");
                option.text = slot;
                option.value = slot;
                freeSlotsDropdown.appendChild(option);
            });
        }
    }

    // Call updateFreeSlots() initially and whenever date or venue selection changes
    updateFreeSlots();
    document.getElementById("date").addEventListener("change", updateFreeSlots);
    document.getElementById("venue").addEventListener("change", updateFreeSlots);
</script>
</html>
