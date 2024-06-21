<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN Summernote -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <?php
    session_start();
    if (isset($_SESSION['member_id'])) {
        $m_id = $_SESSION['member_id'];
    }
    include("../condb.php");
    ?>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            /* background-color: #f8f9fa; */
            /* สีพื้นหลังทั่วไป */
            color: #495057;
        }

        .alert {
            background-color: #17a2b8;
            color: #fff;
            border-radius: 8px;
        }

        .node {
            margin: 0;
            display: flex;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            flex-direction: column;
        }

        .node label {
            display: inline-block;
            margin-right: 15px;
            font-size: 18px;
        }

        .node input[type="radio"] {
            margin-right: 5px;
        }

        #summernote {
            width: 100%;
            height: 200px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .node textarea {
            width: 100%;
            padding: 10px;
            border: 3px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .node input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }

        .node input[type="submit"]:hover {
            background-color: #218838;
        }

        input.post {
            background: #28a745;
            border-radius: 999px;
            box-shadow: 0 10px 20px -10px #28a745;
            color: #FFFFFF;
            cursor: pointer;
            font-family: Inter, Helvetica, "Apple Color Emoji", "Segoe UI Emoji", NotoColorEmoji, "Noto Color Emoji", "Segoe UI Symbol", "Android Emoji", EmojiSymbols, -apple-system, system-ui, "Segoe UI", Roboto, "Helvetica Neue", "Noto Sans", sans-serif;
            font-size: 16px;
            font-weight: 500;
            line-height: 24px;
            opacity: 1;
            outline: none;
            padding: 8px 18px;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            width: fit-content;
            word-break: break-word;
            border: 0;
        }

        .r-img {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="review-line">
            <div class="review-line-right"></div>
            <h2 class="review-heading">รีวิว</h2>
            <div class="review-line-left"></div>
        </div>


        <div class="node">
            <!-- HTML Form for Review -->
            <div class="checkbox-wrapper-2">
                <input type="checkbox" class="sc-gJwTLC ikxBAC">
            </div>
            <form class="checkbox-wrapper" action="review_db.php" method="post" enctype="multipart/form-data">

                <!-- <label for="rating1">
                    <input type="radio" name="rating" id="rating1" value="1"> 1 ดาว -->
                <!-- </label> -->


                <div class="checkbox-wrapper-30">

                    <label for="num">คะแนนการรีวิว :</label>
                    <span class="checkbox">
                        <input type="radio" name="rating" id="rating1" value="1" />
                        <svg>
                            <use xlink:href="#checkbox-30" class="checkbox"></use>
                        </svg>
                    </span>
                    <p class="rating-c">1 ดาว</p>
                    <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                        <symbol id="checkbox-30" viewBox="0 0 22 22">
                            <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2" />
                        </symbol>
                    </svg>

                    <span class="checkbox">
                        <input type="radio" name="rating" id="rating1" value="2" />
                        <svg>
                            <use xlink:href="#checkbox-30" class="checkbox"></use>
                        </svg>
                    </span>
                    <p class="rating-c">2 ดาว</p>
                    <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                        <symbol id="checkbox-30" viewBox="0 0 22 22">
                            <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2" />
                        </symbol>
                    </svg>

                    <span class="checkbox">
                        <input type="radio" name="rating" id="rating1" value="3" />
                        <svg>
                            <use xlink:href="#checkbox-30" class="checkbox"></use>
                        </svg>
                    </span>
                    <p class="rating-c">3 ดาว</p>
                    <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                        <symbol id="checkbox-30" viewBox="0 0 22 22">
                            <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2" />
                        </symbol>
                    </svg>

                    <span class="checkbox">
                        <input type="radio" name="rating" id="rating1" value="4" />
                        <svg>
                            <use xlink:href="#checkbox-30" class="checkbox"></use>
                        </svg>
                    </span>
                    <p class="rating-c">4 ดาว</p>
                    <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                        <symbol id="checkbox-30" viewBox="0 0 22 22">
                            <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2" />
                        </symbol>
                    </svg>

                    <span class="checkbox">
                        <input type="radio" name="rating" id="rating1" value="5" />
                        <svg>
                            <use xlink:href="#checkbox-30" class="checkbox"></use>
                        </svg>
                    </span>
                    <p class="rating-c">5 ดาว</p>
                    <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                        <symbol id="checkbox-30" viewBox="0 0 22 22">
                            <path fill="none" stroke="currentColor" d="M5.5,11.3L9,14.8L20.2,3.3l0,0c-0.5-1-1.5-1.8-2.7-1.8h-13c-1.7,0-3,1.3-3,3v13c0,1.7,1.3,3,3,3h13 c1.7,0,3-1.3,3-3v-13c0-0.4-0.1-0.8-0.3-1.2" />
                        </symbol>
                    </svg>
                </div>

                <label for="comment"></label>
                <textarea name="comment" id="summernote" rows="4"></textarea>
                <br>
                <input type="file" id="imageInput" name="image">
                <input type="hidden" id="r_img" name="r_img" class="r-img">
                <br><br>
                <input class="post" type="submit" value="โพสต์">
            </form>
        </div>
    </div>
    <script>
        $('#summernote').summernote({
            placeholder: 'กรุณาคอมเมนต์อย่างสุภาพ',
            tabsize: 2,
            height: 60,
            toolbar: [
                ['font', ['bold', 'underline']],
                ['insert', ['link']]
                // ['style', ['style']],
                // ['font', ['bold', 'underline', 'clear']],
                // ['color', ['color']],
                // ['para', ['ul', 'ol', 'paragraph']],
                // ['table', ['table']],
                // ['insert', ['link', 'picture', 'video']],
                // ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        document.addEventListener('DOMContentLoaded', function() {
            var checkbox = document.querySelector('.sc-gJwTLC.ikxBAC');
            var checkboxWrapper = document.querySelector('.checkbox-wrapper');

            checkbox.addEventListener('click', function() {
                if (checkbox.checked) {
                    checkboxWrapper.style.display = 'block';
                } else {
                    checkboxWrapper.style.display = 'none';
                }
            });

            // ตรวจสอบสถานะเริ่มต้นของ checkbox และแสดงหรือซ่อนฟอร์มตามตรง
            if (checkbox.checked) {
                checkboxWrapper.style.display = 'block';
            } else {
                checkboxWrapper.style.display = 'none';
            }
        });
    </script>
</body>

</html>