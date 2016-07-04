<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
</head>
<body>
<script src="../vendor/components/jquery/jquery.min.js"></script>
<script src="assets/js/fb.js"></script>
<script src="assets/js/app.js"></script>
<script>

</script>
<div class="header">
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

<div class="content">
    <?=$content;?>
</div>

<div class="footer">
</div>
</body>
</html>