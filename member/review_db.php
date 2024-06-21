<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();
if (isset($_SESSION['member_id'])) {
  $m_id = $_SESSION['member_id'];
}
// Include database connection
include("../condb.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data
  $rating = isset($_POST["rating"]) ? $_POST["rating"] : 0;
  $comment = $_POST["comment"];

  $date = date("Ymd_His");
  $numrand = mt_rand(1, 3);
  $upload = $_FILES['image']['name'];

  if ($upload != '') {
    $path = "../image/review_image/";
    $type = strrchr($_FILES['image']['name'], ".");
    $newname = $numrand . $date . $type;
    $path_copy = $path . $newname;
    move_uploaded_file($_FILES['image']['tmp_name'], $path_copy);
  } else {
    $newname = '';
  }

  // Insert into the database
  $sql = "INSERT INTO tbl_reviews (m_id, rating, comment, r_img) VALUES ('$m_id', '$rating', '$comment', '$newname')";
  $result = mysqli_query($con, $sql);

  if ($result) {
    echo "Review submitted successfully!";
    echo "<script>
            Swal.fire({
              title: 'ทำรายการสำเร็จ',
              icon: 'success',
              confirmButtonText: 'ตกลง'
            }).then(() => {
              window.location='index.php';
            });
          </script>";
  } else {
    echo "Error submitting review: " . mysqli_error($con);
  }
}
?>