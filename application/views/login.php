<div class="login">
    <?= $template_home_login ?>
</div>
<?php    

//Add Styles
Helper_HTML::add_style('<link rel="stylesheet" type="text/css" href="/css/vp.login.css"/>');

//Add Scripts
Helper_HTML::add_script('<script type="text/javascript" src="/js/vp/vp.login.users.js"></script>');
Helper_HTML::add_script('<script src="https://www.paypalobjects.com/js/external/api.js"></script>');

//Add OnReady Script
$msg = isset($error_msg) ? $error_msg: '';
$paypal_access_setting = Helper_PayPalAccess::get_login_settings();
$on_ready = <<<"ONREADY"
    <script>
  $(document).ready(function () {

     var vp = VirtualPiggy || {};

     vp.login.users.setOptions({
                  \$fieldValidationError  : \$('.field-validation-error'),
                  \$formInputs  : \$('input')
              });

     vp.login.users.loginError('$msg');
     
     VP.Login.Init();

     paypal.use(["login"], function (login) {
            login.render($paypal_access_setting);
        });
  });
</script>
ONREADY
;
Helper_HTML::add_script($on_ready);
?>