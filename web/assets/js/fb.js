    logInWithFacebook = function() {
        FB.login(function(response) {
            if (response.authResponse) {
                alert('You are logged in &amp; cookie set!');
                // Now you can redirect the user or do an AJAX request to
                // a PHP script that grabs the signed request from the cookie.
                $.ajax({
                    method: "POST",
                    async: true,
                    url: "index.php?action=login",
                    data: {},
                    success: function(result) {
                        $("body").html(result);
                    }
                });
            } else {
                alert('User cancelled login or did not fully authorize.');
            }
        });
        return false;
    };
    window.fbAsyncInit = function() {
        FB.init({
            appId: '286994848357270',
            cookie: true, // This is important, it's not enabled by default
            version: 'v2.2'
        });
    };
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.6&appId=286994848357270";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    /*
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));*/