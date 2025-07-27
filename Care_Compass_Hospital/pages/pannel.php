<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: ../admin.php");
    exit();
}

include('../server/DB_Connect.php');

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $sql = "SELECT name FROM staff WHERE email = '$email'"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $firstName = $row['name'];
    } else {
       
        $firstName = 'Admin';
        $lastName = '';
    }
} else {
   
    echo "You need to log in first.";
    exit();
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap');

        body {

            margin: 0;
            padding: 0;
            display: flex;
        }

        * {
            font-family: 'Poppins', sans-serif;

        }

        #dashboard h2 {
            width: 100%;
        }

        .admin-container {
            display: flex;
            width: 100%;
        }

        .sidebar {
            width: 250px;
            background-color: rgba(10, 97, 201, 1);
            color: white;
            padding: 20px;
            height: 100vh;
        }

        .sidebar h2 {
            text-align: left;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .sidebar ul li:hover {
            background-color: rgb(8, 61, 127);
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .tab {
            display: none;
        }

        .tab.active {
            display: block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: rgba(10, 97, 201, 1);
            color: white;
        }

        button {
            padding: 5px 10px;
            border: none;
            background: red;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: darkred;
        }


        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 25px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 4px;
            bottom: 3px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #0a61c9;
        }

        input:checked+.slider:before {
            transform: translateX(24px);
        }

        .staffIn {
            width: 80%;
        }

        #addStaff input {
            width: 98%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #addStaff select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #addStaff button {
            width: 100%;
            padding: 10px;
            background: #0a61c9;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        #addStaff button:hover {
            background: #084b9a;
        }

        #staffMessage {
            color: red;
            margin-top: 10px;
        }



        #medical input {
            width: 98%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #medical select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #medical button {
            width: 100%;
            padding: 10px;
            background: #0a61c9;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        #medical button:hover {
            background: #084b9a;
        }

        .count {
            margin: 20px 0px;
        }

        .cin {
            display: grid;
            grid-template-columns: auto auto auto;
            gap: 10px;
        }

        .countBox {
            border: 3px solid #0a61c9;
            border-radius: 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="admin-container">
        <div class="sidebar">
            <ul>
                <li onclick="openTab('dashboard')">Dashboard</li>


                <?php
                include('../server/DB_Connect.php');


                if (isset($_SESSION['email'])) {
                    $email = $_SESSION['email'];

                    
                    $query = "SELECT position FROM staff WHERE email = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $stmt->bind_result($position);
                    $stmt->fetch();
                    $stmt->close();

                    
                    if ($position === "admin") {
                        echo '<li onclick="openTab(\'addStaff\')">Add Staff</li>';
                        echo '<li onclick="openTab(\'Staff\')">Staff Members</li>';

                    } else {
                        echo '<li onclick="openTab(\'medical\')">Medical Records</li>';
                        echo '<li onclick="openTab(\'appointment\')">Appointment</li>';
                    }
                }
                ?>


                <li onclick="openTab('newsletter')">Newsletter</li>
                <li onclick="openTab('contacts')">Contact Requests</li>
            </ul>
        </div>

        <div class="content">
            <div id="dashboard" class="tab active">

                <h2>Welcome, <?php echo $firstName ?></h2>

                <div class="count">
                    <div class="cin">
                        <div class="countBox">
                            <h1 id="usersCount"></h1>
                            <p>Patients</p>
                        </div>
                        <div class="countBox">
                            <h1 id="appointmentsCount"></h1>
                            <p>Appointments</p>
                        </div>
                        <div class="countBox">
                            <h1 id="contactsCount"></h1>
                            <p>Contact</p>
                        </div>
                        <div class="countBox">
                            <h1 id="staffCount"></h1>
                            <p>Staff</p>
                        </div>
                        <div class="countBox">
                            <h1 id="newslettersCount"></h1>
                            <p>Newsletters</p>
                        </div>
                    </div>
                </div>


                <button onclick="window.location.href='../server/logOutStaff.php'">Logout</button>

            </div>

            <div id="appointment" class="tab">
                <h2>Appointment</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Service</th>
                            <th>Branch</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="appointmentsTable">

                    </tbody>
                </table>
            </div>


            <div id="Staff" class="tab">
                <h2>Staff members</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Number</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="staffTable">

                    </tbody>
                </table>
            </div>

            <div id="addStaff" class="tab">

                <h2>Add New Staff</h2>
                <div id="staffForm">
                    <label for="staffName">Full Name:</label><br>
                    <input type="text" id="staffName" placeholder="Enter full name" required> <br>

                    <label for="staffNumber">Phone Number:</label><br>
                    <input type="text" id="staffNumber" placeholder="Enter phone number" required><br>

                    <label for="staffEmail">Email:</label><br>
                    <input type="email" id="staffEmail" placeholder="Enter email" required><br>

                    <label for="staffPosition">Position:</label><br>
                    <select id="staffPosition" required>
                        <option value="Select a position">Select a position</option>
                        <option value="Manager">Manager</option>
                        <option value="Cleaner">Doctor</option>
                        <option value="Cleaner">Nurse</option>
                        <option value="Receptionist">Receptionist</option>
                        <option value="Cleaner">Cleaner</option>
                    </select><br>

                    <label for="staffPassword">Password:</label><br>
                    <input type="password" id="staffPassword" placeholder="Enter password" required><br>

                    <button id="staffAdd">Add Staff</button>
                </div>

                <p id="staffMessage"></p>

            </div>

            <div id="medical" class="tab">

                <form id="medicalForm" method="POST" enctype="multipart/form-data">
                    <label for="email">Patient Email:</label><br>
                    <input type="email" id="email" name="email" required><br>
                    <span class="error" id="error-email"></span><br>

                    <label for="disease">Disease:</label><br>
                    <input type="text" id="disease" name="disease" required><br>
                    <span class="error" id="error-disease"></span><br>

                    <label for="date">Date:</label><br>
                    <input type="date" id="date" name="date" required><br>
                    <span class="error" id="error-date"></span><br>

                    <label for="file">Upload PDF Document (Optional):</label><br>
                    <input type="file" id="file" name="file" accept=".pdf"><br>
                    <span class="error" id="error-file"></span><br><br>

                    <button type="submit" id="submitBtn">Submit</button>
                </form>

                <p id="success-msg" style="color: green;"></p>
                <p id="error-msg" style="color: red;"></p>


            </div>


            <div id="newsletter" class="tab">
                <h2>Newsletter Subscribers</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Date Subscribed</th>
                        </tr>
                    </thead>
                    <tbody id="newsletterTable">

                    </tbody>
                </table>
            </div>

            <div id="contacts" class="tab">
                <h2>Contact Requests</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="contactTable">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>



      

        function loadCounts() {
            $.ajax({
                url: "../server/get_counts.php", 
                type: "GET",
                dataType: "json",
                success: function (response) {
                    $("#appointmentsCount").text(response.appointments);
                    $("#contactsCount").text(response.contact_messages);
                    $("#staffCount").text(response.staff);
                    $("#newslettersCount").text(response.newsletters);
                    $("#usersCount").text(response.users);
                },
                error: function (response) {
                    $("#appointmentsCount, #contactsCount, #staffCount, #newslettersCount, #usersCount").text("Error");
                    console.log(response)
                }
            });
        }


       
        function loadAppointments() {
            $.ajax({
                url: "../server/get_appointments.php",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    let rows = "";
                    data.forEach(appointment => {
                        rows += `<tr>
                            <td>${appointment.first_name} ${appointment.last_name}</td>
                            <td>${appointment.date}</td>
                            <td>${appointment.service}</td>
                            <td>${appointment.branch}</td>
                            <td>${appointment.email}</td>
                            <td>${appointment.phone_number}</td>
                            <td><button onclick="deleteAppointment(${appointment.id})">Cancel</button></td>
                        </tr>`;
                    });
                    $("#appointmentsTable").html(rows);
                },
                error: function () {
                    alert("Failed to load appointments.");
                }
            });
        }

       
        function loadStaff() {
            $.ajax({
                url: "../server/get_staff.php", 
                type: "GET",
                dataType: "json",
                success: function (data) {
                    let rows = "";
                    data.forEach(staff => {
                        rows += `<tr>
                                        <td>${staff.name}</td>
                                        <td>${staff.number}</td>
                                        <td>${staff.email}</td>
                                        <td>${staff.position}</td>
                                        <td><button onclick="deleteStaff(${staff.id})">Remove</button></td>
                                    </tr>`;
                    });
                    $("#staffTable").html(rows);
                },
                error: function () {
                    alert("Failed to load staff.");
                }
            });
        }


        

        $("#staffAdd").click(function (event) {
            event.preventDefault(); 

            let name = $("#staffName").val().trim();
            let number = $("#staffNumber").val().trim();
            let email = $("#staffEmail").val().trim();
            let position = $("#staffPosition").val();
            let password = $("#staffPassword").val().trim();

            if (!name || !number || !email || !position || !password) {
                $("#staffMessage").text("All fields are required!").css("color", "red");
                return;
            }

            
            let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!email.match(emailPattern)) {
                $("#staffMessage").text("Invalid email format!").css("color", "red");
                return;
            }

            $.ajax({
                url: "../server/add_staff.php",
                type: "POST",
                data: { name, number, email, position, password },
                success: function (response) {
                    if (response.trim() === "success") {
                        $("#staffMessage").text("Staff added successfully!").css("color", "green");
                        $("input").val("");
                        $("select").val("Select a position");
                        loadStaff();
                        loadCounts();
                    } else {
                        $("#staffMessage").text(response).css("color", "red");
                    }
                },
                error: function () {
                    $("#staffMessage").text("Error adding staff. Try again!").css("color", "red");
                }
            });
        });



        $(document).ready(function () {

           


            $('#medicalForm').on('submit', function (e) {
                e.preventDefault();  

                
                $(".error").text("");
                $("#success-msg").text("");
                $("#error-msg").text("");

                let email = $("#email").val().trim();
                let disease = $("#disease").val().trim();
                let date = $("#date").val().trim();
                let file = $("#file")[0].files[0];

                let isValid = true;

               
                if (!email || !email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                    $("#error-email").text("Enter a valid email.");
                    isValid = false;
                }
                if (!disease) {
                    $("#error-disease").text("Disease is required.");
                    isValid = false;
                }
                if (!date) {
                    $("#error-date").text("Date is required.");
                    isValid = false;
                }

                if (!isValid) return;

                
                let formData = new FormData(this);

                $.ajax({
                    url: "../server/upload_medical.php",  
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response === "success") {
                            $("#success-msg").text("Medical details added successfully.");
                            $("#medicalForm")[0].reset();  

                        } else {
                            $("#error-msg").text("Error submitting data. Please try again.");
                            console.log(response)
                        }
                    },
                    error: function () {
                        $("#error-msg").text("Server error. Please try again.");
                    }
                });
            });






           
            function loadContacts() {
                $.ajax({
                    url: "../server/get_contacts.php", 
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        let rows = "";
                        data.forEach(contact => {
                            rows += `<tr>
                                        <td>${contact.first_name} ${contact.last_name}</td>
                                        <td>${contact.email}</td>
                                        <td>${contact.phone}</td>
                                        <td>${contact.message}</td>
                                        <td>${contact.submitted_at}</td>
                                    </tr>`;
                        });
                        $("#contactTable").html(rows);
                    },
                    error: function () {
                        alert("Failed to load messages.");
                    }
                });
            }














            
            function loadNewsletters() {
                $.ajax({
                    url: "../server/get_newsletters.php", 
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        let rows = "";
                        data.forEach(newsletter => {
                            rows += `<tr>
                                        <td>${newsletter.email}</td>
                                        <td>${newsletter.subscribed_at}</td>
                                    </tr>`;
                        });
                        $("#newsletterTable").html(rows);
                    },
                    error: function () {
                        
                    }
                });
            }


            loadAppointments();
            loadNewsletters();
            loadContacts();
            loadStaff();
            loadCounts();
        });


       
        function deleteStaff(id) {
            if (confirm("Are you sure you want to delete this member?")) {
                $.ajax({
                    url: "../server/delete_staff.php",
                    type: "POST",
                    data: { id: id },
                    success: function (response) {
                        if (response.trim() === "success") {
                            alert("Member removed successfully.");
                            loadStaff();
                            loadCounts();
                        } else {
                            alert("Failed to remove member.");
                        }
                    },
                    error: function () {
                        alert("Server error. Try again.");
                    }
                });
            }
        }



        
        function deleteAppointment(id) {
            if (confirm("Are you sure you want to cancel this appointment?")) {
                $.ajax({
                    url: "../server/delete_appointment.php",
                    type: "POST",
                    data: { id: id },
                    success: function (response) {
                        if (response.trim() === "success") {
                            alert("Appointment canceled successfully.");
                            loadAppointments();
                            loadCounts();
                        } else {
                            alert("Failed to cancel appointment.");
                        }
                    },
                    error: function () {
                        alert("Server error. Try again.");
                    }
                });
            }
        }





        function openTab(tabName) {
            let tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => tab.classList.remove('active'));
            document.getElementById(tabName).classList.add('active');
        }

       
        function toggleBooking(checkbox) {
            let status = checkbox.checked ? "enabled" : "disabled"; 
            $('#bookingStatus').text(`Booking Form: ${status}`)

            $.ajax({
                url: "../../server/update_status.php", 
                type: "POST",
                data: { status: status }, 
                success: function (response) {
                    alert(response); 
                },
                error: function () {
                    alert("Failed to update status");
                }
            });
        }

    </script>
</body>

</html>