<?php require_once( 'config.php' ); ?>
                                                                            <?php $sliderHeader = array( '{{customHeadTags}}' => '
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.slidepanel.js"></script>
        <link rel="stylesheet" type="text/css" href="css/jquery.slidepanel.css">
    ');

    $email = "you@my.bcit.ca";
?>
<?php renderPagelet( 'header.php', array( '{{customHeadTags}}' => '' ) ); ?>

    <body>
        <div data-role="page" data-theme="a">
            <?php define('HAS_MENU',1);
                  renderPagelet( 'banner.php', array( '{{title}}' => 'Account Settings' ) ); ?>

			<div class="contenta" data-role="content" data-theme="a">
                <div class="center contenta">
                    <p><?php echo $email; ?></p>
                </div>

                <div data-role="collapsible">
                    <h3>Change your display name</h3>
                    <form id="name-change" name="name-change" method="POST">
                        <label for="display-name">New Name:</label>
                        <input type="text" name="display-name" id="display-name">
                        <input id="update-name" type="button" value="Update Name">
                        <input type="hidden" name="method" value="update-display-name" />
                    </form>
                </div>
                <div id="name-change-success" style="display:none">
                        <p>Name Change Successful!</p>
                </div>
                      
                <div data-role="collapsible">
                    <h3>Change your password</h3> 
				    <form id="password-change" name="password-change" method="POST">
                        <input type="hidden" name="email" value="placeholder@my.bcit.ca">

                        <label for="old-password">Current Password:</label>
					    <input type="password" name="old-password" id="old-password" required><br/>


					    <label for="new-password">New Password:</label>
					    <input type="password" name="new-password" id="new-password" required><br/>


					    <label for="confirm-password">Confirm New Password:</label>
					    <input type="password" name="confirm-password" id="confirm-password" required><br/>


                        <input id="update-password" type="button" value="Update Password">
                        <input type="hidden" name="method" value="update-password">
				    </form>
                    <div id="mismatch" style="display:none">
                        <p>Please check your new passwords</p>
                    </div>
                </div>
                <div data-role="collapsible">
                    <h3>Deactivate your account</h3>
                    <form id="name-change" name="name-change" method="POST">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" required><br/>
                        <input id="deactivate-account" type="button" value="Deactivate Account">
                        <input type="hidden" name="method" value="deactivate-account" />
                    </form>
                </div>
			</div>
			<div data-role="footer" id="footer">
			</div>
		</div>
        <script>
            $('#confirm-password').blur(function () {
                $('#update-password').attr('disabled', 'disabled');
                $('#mismatch').hide();
                var match1 = $('#new-password').val();
                var match2 = $('#confirm-password').val();
                if (match1 != match2) {
                    $('#mismatch').show();
                    $('#update-password').attr('disabled');
                }
                return false;
            });

            $('#update-password').click(function () {
                alert('belly');
                var passwordForm = $("#update-password").serializeArray();
                $.ajax({
                    type: "POST",
                    url: <?php echo '\'' . AJAX_URL . 'user/settings.php\''; ?>,
                    data: passwordForm,
                    error: onPasswordChange,
                    datatype: 'json'
                });
                alert('hello');
            });

            $('#update-name').click(function () {
                alert('starting updating name');
                var updateNameForm = $("#update-name").serializeArray();

                $.ajax
                ({
                    type: "POST",
                    url: <?php echo '\'' . AJAX_URL . 'user/settings.php\''; ?>,
                    data: updateNameForm,
                    datatype: 'json',
                    success: function (json) {
                        if (json.success == true) { 
                            nameChangeSuccess();
                        }
                    },
                    error: errorMessage()
                });
            });

            $('#deactivate-account').click(function () {
                alert('account deactivation button pressed');
                var deactivateAccountForm = $("#deactivate-account").serializeArray();

                $.ajax
                ({
                    type: "POST",
                    url: <?php echo '\'' . AJAX_URL . '/ajax/user/auth.php\''; ?>,
                    data: deactivateAccountForm,
                    datatype: 'json',
                    success: function (json) {
                        if (json.deleted == true)
                        {
                            alert('Study Buddy account deactivated.');
                            redirectToMain();
                        }
						},
                    error: errorMessage()
                });
            });

            function onPasswordChange(data) {
                alert('HI!');
            }

            function errorMessage() {
                alert('error message');
            }

            function nameChangeSuccess() {
                $('#name-change-succcess').show();
            }

            function redirectToMain()
            {
                window.location.assign("main.php");
            }
        </script>
	</body>
</html>