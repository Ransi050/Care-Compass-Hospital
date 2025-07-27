<?php
include ('./DB_Connect.php');

if (isset($_GET['search'])) {
    $search = "%" . $_GET['search'] . "%";
    $stmt = $conn->prepare("SELECT name, url FROM services WHERE name LIKE ?");
    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<div onclick='window.location.href=\"" . $row['url'] . "\"'>" . $row['name'] . "</div>";
    }
}
?>

