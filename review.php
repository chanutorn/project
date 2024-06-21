<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index_css/review.css">
    <?php include('thai_date.php'); ?>
</head>

<body>
    <div class="container">
        <div class="review-line">
            <div class="review-line-right"></div>
            <h2 class="review-heading">รีวิว</h2>
            <div class="review-line-left"></div>
        </div>
        <div class="alert" role="alert">
            <!-- <h2 class="review-section">รีวิว</h2> -->
            <div class="review-container">
                <?php
                $sql = "SELECT * FROM tbl_reviews AS r INNER JOIN tbl_member AS m ON m.member_id = r.m_id";
                $result = mysqli_query($con, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <div class='review-item'>
                        <div class='review-header'>
                            <div class='user-info'>
                                <h5><?php echo $row['m_name']; ?></h5>
                                <span class='review-date'>วันที่รีวิว: <?php echo thai_date(strtotime($row['review_date'])) ?></span>
                            </div>
                        </div>
                        <div class='review-content'>
                            <p> <?php echo $row['comment']; ?> </p>
                            <div class='rating'>
                                <!-- <span class='star' style="color: #ffc107;">&#9733;</span> -->
                                <?php echo str_repeat("<span class='star'>&#9733;</span>", $row['rating']); ?>
                                <span class='rating-score' style="color: #000;"> <?php echo $row['rating']; ?> /5</span>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>

</body>

</html>