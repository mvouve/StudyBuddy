<!--Beginning of my-meetings.php-->
    <div data-role="page" data-theme="a" id="page-my-meetings">
        <?php renderPagelet( 'banner.php', array( '{{title}}' => 'My Meetings') ); ?>
        <form id="get-my-meetings-form" name="get-my-meetings-form" method="POST">
            <input type="hidden" name="method" value="get-meetings" />
        </form>        
        <div data-role="content" class="listview-wrapper">
            <ul data-role="listview" data-filter="true" id="my-meetings-list">
            </ul>
        </div>
        <div data-role="footer" data-position="fixed" data-tap-toggle="false">
            <div data-role="navbar">
                <ul>
<<<<<<< HEAD
                    <li><a href="#" data-icon="plus" data-iconpos="top" id="i-created">I created</a></li>
                    <li><a href="#" data-icon="plus" data-iconpos="top" id="all-meeting">All meetings</a></li>
                    <li><a href="#" data-icon="plus" data-iconpos="top" id="i-attending">Meetings I'm Attending</a></li>
=======
                    <li><a href="#" id="create-meeting-button" data-icon="plus" data-iconpos="top">Create Meeting</a></li>
                    <li><a href="#" id="cancel-meeting-button" data-icon="plus" data-iconpos="top">Cancel my meeting</a></li>
                    <li><a href="#" id="all-meetings-button" data-icon="plus" data-iconpos="top">All meetings</a></li>
                    <li><a href="#" id="attending-meetings-button" data-icon="plus" data-iconpos="top">Meetings I'm Attending</a></li>
>>>>>>> FETCH_HEAD
                </ul>
            </div>
        </div>
    </div>
<<<<<<< HEAD
<script>
    /*
    $( '#i-created' ).on( 'click tap', function(e)
        {
            
        
            var templist;
            for(blabla)
            {
                if(beepboop.filter == '2')
                {
                    //add to list
                }
            }
            //remove current list
            //append new list
            //refresh
        });
    $( '#all-meeting' ).on( 'click tap', function(e)
        {
            //remove current list
            //append original list from request
            //refresh
        });
    $( '#i-attending' ).on( 'click tap', function(e)
        {
            var templist;
            for(blabla)
            {
                if(beepboop.filter == '1')
                {
                    //add to list
                }
            }
            //remove current list
            //append new list
            //refresh
        });
    
    function regenerateList(iCreated,allMeeting,iAttending)
    {    
        var templist;
        for(blablabla)
        {
            if(iCreated)
            {
                if(bla.filter == '2')
                {
                    addMeetingToList(bla);
                }
            }
            if(allMeeting)
            {
                while(templist.length != 0)
                {
                    removeMeetingfromList(templist[i]);
                }
                while(list.length != templist.length)
                {
                    addMeetingToList(list[i]);
                }
            }
            if(iAttending)
            {
                
            }
        }
    }
    
    function addMeetingToList()
    {

    }
    
    function removeMeetingFromList()
    {
    
    }
    */
    
    
</script>
<!--End of my-meetings.php-->
=======
    <script>
        //
    </script>
<!--End of my-meetings.php-->
>>>>>>> FETCH_HEAD
