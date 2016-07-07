<!DOCTYPE html>
<html>
<head>
<title>Light-It test</title>
<meta charset="UTF-8">
<link href="../vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
<link href="./assets/css/style.css" rel="stylesheet">
</head>
<body>
<script src="../vendor/components/jquery/jquery.min.js"></script>
<script src="./assets/js/fb.js"></script>
<script src="./assets/js/messages.js"></script>
<script src="./assets/js/comments.js"></script>

<div class="container-fluid">
<div class="wrapper col-md-8 col-md-offset-2">

    <div class="row">
    <div class="facebook">
        <div id="fb-root"></div>

        <div
            class="fb-login-button"
            data-max-rows="1"
            data-size="large"
            data-show-faces="false"
            data-auto-logout-link="true"
            onlogin="onLogin()"
        ></div>
    </div>
    </div>

    <div class="row">
        <div class="header">
        <?=$header;?>
        </div>
    </div>

    <div class="row">
        <div class="content">
        <?=$content;?>
        </div>
    </div>

    <div class="row">
        <div class="footer">
        <?=$footer;?>
        </div>
    </div>

</div> <!-- wrapper -->
</div> <!-- container-flud -->
</body>
</html>