function onLogin() {
    $.ajax({
        method: "POST",
        async: true,
        url: "index.php?action=login",
        data: {},
        success: function() {
            location.reload();
        }
    });
}
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