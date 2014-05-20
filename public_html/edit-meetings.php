<!-- edit meetings page-->
<?php require_once( 'config.php' ); ?>
<?php require_once( PHP_INC_PATH . 'common.php' ); ?>
<?php if ( isset( $_GET['logout'] ) ) { User::instance()->logout(); } ?>
<?php renderPagelet( 'header.php', array( '{{customHeadTags}}' => '' ) ); ?>

<div data-role="page">
    <div data-role="header">
    </div>

    <div data-role="main" id="edit-meeting-div">
        <form id="create-edit-meeting-form" name="create-edit-meeting-form" method="post">
            <label for="course-dropdown">Course :</label><br/>
            <select id="course-dropdown" name="course-dropdown"></select><br/>

            <label for="location-dropdown">Location :</label><br/>
            <select id="location-dropdown" name="location-dropdown"></select><br/>

            <label for="meeting-start-datetime">Start Time :</label><br/>
            <input id="meeting-start-datetime" name="meeting-start-datetime" type="text"><br/>

            <label for="meeting-end-datetime">End Time :</label><br/>
            <input id="meeting-end-datetime" name="meeting-end-datetime" type="text"><br/>

            <label for="max-buddies">Maximum Buddies :</label><br/>
            <input id="max-buddies" name="max-buddies" type="text"><br/>

            <label for="meeting-comments">Comments :</label><br/>
            <textarea id="meeting-comments" name="meeting-comments"></textarea><br/>

        </form>
    </div>
            <!-- save meeting and cancel buttons go here?-->
    <div data-role="footer" data-position="fixed" data-tap-toggle="false">
                <div data-role="navbar">
		            <ul>
			            <li><a href="#page-my-courses" data-icon="back" data-iconpos="top">Cancel</a></li>
			            <li><a href="#page-add-course" data-icon="plus" data-iconpos="top">Create Meeting</a></li>
		            </ul>
	            </div>
            </div>
</div>

<!-- added to include the datetime picker plugin, info at: http://www.jqueryrain.com/?lnsG0UbP -->
<link rel="stylesheet" type="text/css" href="/jquery.datetimepicker.css"/>
<script src="/jquery.js"></script>
<script src="/jquery.datetimepicker.js"></script>
<script>
    jQuery('#datetimepicker').datetimepicker();
</script>
