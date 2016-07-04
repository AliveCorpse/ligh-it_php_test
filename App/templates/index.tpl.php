<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
</head>
<body>
<script src="../vendor/components/jquery/jquery.min.js"></script>
<script src="assets/js/fb.js"></script>
<script>
    function onLogin(){
         $.ajax({
            method: "POST",
            async: true,
            url: "index.php?action=login",
            data: {
            },
            success: function(result) {
               $(".content").html(result);
            }
        });
    }
</script>
<div id="fb-root"></div>

<div class="header">
    <p><a href="#" onClick="logInWithFacebook()">Log In with the JavaScript SDK</a></p>

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