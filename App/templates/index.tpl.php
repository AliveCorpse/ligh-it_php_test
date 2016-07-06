<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
</head>
<body>
<script src="../vendor/components/jquery/jquery.min.js"></script>
<script src="./assets/js/fb.js"></script>
<script src="./assets/js/messages.js"></script>
<script src="./assets/js/comments.js"></script>

<div class="container">

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

    <div class="header">
        <?=$header;?>
    </div>

    <div class="content">
        <?=$content;?>
    </div>

    <div class="footer">
        <?=$footer;?>
    </div>
</div>
</body>
</html>