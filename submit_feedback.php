<?php
// DB connection settings
$host = 'localhost';  // Database host (use your server's address if different)
$dbname = 'student_feedback';  // Database name
$username = 'root';  // Database username
$password = '';  // Database password

try {
    // Create a PDO connection to MySQL
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get form data
        $studentName = $_POST['studentName'];
        $course = $_POST['course'];
        $feedback = $_POST['feedback'];
        $rating = $_POST['rating'];

        // Prepare SQL query to insert the feedback into the database
        $sql = "INSERT INTO feedback (studentName, course, feedback, rating) 
                VALUES (:studentName, :course, :feedback, :rating)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':studentName', $studentName);
        $stmt->bindParam(':course', $course);
        $stmt->bindParam(':feedback', $feedback);
        $stmt->bindParam(':rating', $rating);

        // Execute the statement
        $stmt->execute();

        // Redirect to a confirmation page or show success message
        echo "<script>alert('Feedback submitted successfully!'); window.location.href='index.html';</script>";
    }
} catch (PDOException $e) {
    // If there is an error with the database connection or query
    echo "Error: " . $e->getMessage();
}
?>
