<!--Study Buddy - Account Registration-->
<?php require( 'config.php' ); ?>
<?php renderPagelet( 'header.php', array( '{{customHeadTags}}' => '' ) ); ?>
    <body>
        <div data-role="page" data-theme="a">
            <?php renderPagelet( 'banner.php', array( '{{title}}' => 'Register Account' ) ); ?>
			<div class="contenta" data-role="content" id="register">
				<form id="register-form" name="register-form" method="POST">
					<label for="email">Email:</label>
                    <div class="" style="position:relative;" id="email-div">
					<input type="text" name="email" id="email"></div>
					<label for="display-name" id="display-name-label">Display Name:</label>
					<input type="text" name="display-name" id="display-name"><br/>
					<label for="password" id="password-label">Password:</label>
					<input type="password" name="password" id="password"><br/>
					<label for="confirm" id="confirm-label">Confirm Password:</label>
					<input type="password" name="confirm-password" id="confirm"><br/>
                    <input id="register-submit" type="submit" value="Register">
                    <input type="hidden" name="method" value="register" />
				</form>
			</div>
			<div data-role="footer" id="footer">
			</div>
		</div>
        <script>
            //used to ensure a user-entered email is a valid BCIT e-mail
            function validateEmail() {
                var emailRegex = /^(([0-9a-z_.]+@((my\.bcit\.ca)|(bcit.ca)))|(a\d{8}@((mybcit\.ca)|(learn\.bcit\.ca))))$/gi;
                var validEmail = document.getElementById("email").value.match(emailRegex);
                if (validEmail == null || validEmail.length != 1) {
                    $("#email-div").attr('class','ui-icon-delete ui-btn-icon-left');
                    return false;
                }
                $("#email-div").attr('class','ui-icon-check ui-btn-icon-left');
                return true;
            }

            //used to ensure a user-entered display name is not null or empty
            function validateDisplayName() {
                var displayNameRegex = /^[0-9A-Za-z-]{5,32}$/g;
                var displayNameLabel = document.getElementById("display-name-label");
                var displayName = document.getElementById("display-name").value.match(displayNameRegex);
                if (displayName == null || displayName.length != 1) {
                    displayNameLabel.style.color="#FF0000";
                    return false;
                }
                displayNameLabel.style.color="#00FF00";
                return true;
            }

            function validatePassword() {
                var passwordRegex = /^.+$/g;
                var passwordLabel = document.getElementById("password-label");
                var confirmLabel = document.getElementById("confirm-label");
                var password = document.getElementById("password").value.match(passwordRegex);
                var confirm = document.getElementById("confirm").value;
                if (password == null || password.length != 1) {
                    passwordLabel.style.color="#FF0000";
                    return false;
                }
                passwordLabel.style.color="#00FF00";
                if ( password[0] != confirm ) {
                    confirmLabel.style.color="#FF0000";
                    return false;
                }
                confirmLabel.style.color="#00FF00";
                return true;

            }

            function onRegister(result) {
                alert(JSON.stringify(result, null, 4));

                // Reset the Submit button to inactive after being pressed
                $.mobile.activePage.find('.ui-btn-active').removeClass('ui-btn-active ui-focus');
            }
            
            $("#email").keyup( function(e){validateEmail();} );
            $("#display-name").keyup( function(e){validateDisplayName();} );
            $("#password").keyup( function(e){validatePassword();} );
            $("#confirm").keyup( function(e){validatePassword();} );

            // Note the change from $().click to $().on( 'click tap', function( e ) {} );
            $("#register-submit").on( 'click tap', function (e) {
                // Use e.preventDefault() to stop page redirection!
                e.preventDefault();
                if( !validateEmail() )
                {
                    alert("Invalid Email!");
                    return;
                }
                if( !validateDisplayName() )
                {
                    alert("Invalid Display Name!");
                    return;
                }
                if( !validatePassword() )
                {
                    alert("Invalid Password pair!");
                    return;
                }
                var formData = $("#register-form").serializeArray();

                $.post( <?php echo '\''.AJAX_URL . 'user/auth.php\''; ?>,
                        formData,
                        onRegister,
                        "json");

            });
        </script>
	</body>
</html>