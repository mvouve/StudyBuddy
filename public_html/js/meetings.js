/* a method to return all the meetings that you are attending.
    returns a 2D array of meetings, each of which contains individual meeting data.
    @param ajax_URL (string): the URI location where the ajax folder is located */

function getAllMeetings( ajax_URL )
{
    $.ajax
    ({
        url: ajax_URL + 'meetings/meetings.php',
        type: 'POST',
        data:
        {
            method: 'get-meetings'
        },
        dataType: "json",
        success: function ( json ) {
            var meetingID = json.id;
            var meetingCreator = json.creatorID;
            var meetingCourse = json.courseID;
            var meetingDesc = json.description;
            var meetingLoc = json.location;
            var meetingStartTime = json.startTime;
            var meetingEndTime = json.endTime;
            var meetingMaxBuddies = json.maxBuddies;
            var meetingBuddies = json.buddies;
            var meetingAttending = json.attending;

            //Do something with all this data now
        }
    });
}

/* a method to return the details for one specific meeting
    returns an array containing a course description string, end date string, max buddies int, and an array of buddies currently signed up to the meeting
    @param ajax_URL (string): 
    @param meetingID (INT): a numeric unique ID for a meeting */

function getMeetingDetails ( ajax_URL, meetingID )
{
    $.ajax
    ({
        url: ajax_URL + 'meetings/meeting-details.php',
        type: 'POST',
        data:
        {
            method: 'get-meetings',
            id: meetingID
        },
        dataType: "json",
        success: function ( json )
        {
            var meetingDesc = json.description;
            var meetingEndDate = json.endDate;
            var meetingMaxBuddies = json.maxBuddies;
            var meetingBuddies = json.buddies //an array of displayNames

            //call a helper function in order to populate the edit meetings page

        }
}
		      
   
/* creates a new meeting
    @param ajax_URL  the URI location where the ajax folder is located
    @param courseID the course being studied at the meeting
    @param CourseDescription a description of the course
    @param meetingLocation the place where the meeting will be held
    @param startTime a datetime string informing when the meeting begins (YYYY-MM-DD HH:MM:SS)
    @param endTime a datetime string informing when the meeting ends (YYYY-MM-DD HH:MM:SS)
    @param maxBuddies the maximum number of people that a location can accomidate */

function createMeeting ( ajax_URL, courseID, courseDescription, meetingLocation, startTime, endTime, maxBuddies )
{
    $.ajax
    ({
        url: ajax_URL + 'meetings/meetings.php',
        type: 'POST',
        data:
        {
            method: 'create-meeting',
            courseId: courseID,
            description: courseDescription,
            location: meetingLocation, 
            startTime: startTime,
            endTime: endTime,
            maxBuddies: maxBuddies
        },
        dataType: "json",
        success: function ( json )
        {
            //to do later
        }
    });
}


/* called when the creator of a meeting needs to change something about the meeting
    @param ajax_URL  the URI location where the ajax folder is located
    @param meetingID: the meeting ID, determiend which meeting is to be altered
    @param courseID the course being studied at the meeting
    @param CourseDescription a description of the course
    @param meetingLocation the place where the meeting will be held
    @param startTime a datetime string informing when the meeting begins (YYYY-MM-DD HH:MM:SS)
    @param endTime a datetime string informing when the meeting ends (YYYY-MM-DD HH:MM:SS)
    @param maxBuddies the maximum number of people that a location can accomidate */
function editMeeting ( ajax_URL, meetingID, courseID, courseDescription, meetingLocation, startTime, endTime, maxBuddies )
{
    $.ajax
    ({
        url: ajax_URL + 'meetings/meetings.php',
        type: 'POST',
        data:
        {
            method: 'edit-meeting',
            id: meetingID,
            courseId: courseID,
            description: courseDescription,
            location: meetingLocation, 
            startTime: startTime,
            endTime: endTime,
            maxBuddies: maxBuddies
        },
        dataType: "json",
        success: function ( json )
        {
            //to do later
        }
    });
}

/* allows a user to cancel a meeting that they have created
    @param ajax_URL  the URI location where the ajax folder is located
    @param meetingID: the meeting ID, determiend which meeting is to be altered */

function cancelMeeting( ajax_URL, meetingID )
{
    $.ajax
    ({
        url: ajax_URL + 'meetings/meetings.php',
        type: 'POST',
        data:
        {
            method: 'cancel-meeting',
            id: userID
        },
        dataType: "json",
        success: function ( json )
        {
            //to do later
        }
    });
}

/* allows a user to join a meeting that someone else has created
    @param ajax_URL  the URI location where the ajax folder is located
    @param meetingID: the meeting ID, determiend which meeting is to be altered */

function joinMeeting ( ajax_URL, meetingID )
{
    $.ajax
    ({
        url: ajax_URL + 'meetings/meetings.php',
        type: 'POST',
        data:
        {
            method: 'join-meeting',
            id: meetingID
        },
        dataType: "json",
        success: function ( json )
        {
            //to do later
        }
    });
}

/* allows a user to remove their userID from being associated with a meeting and reduces the number
    of buddies attending a meeting by 1.
    @param ajax_URL  the URI location where the ajax folder is located
    @param meetingID: the meeting ID, determiend which meeting is to be altered */

function leaveMeeting ( ajax_URL, meetingID )
{
    $.ajax
    ({
        url: ajax_URL + 'meetings/meetings.php',
        type: 'POST',
        data:
        {
            method: 'leave-meeting',
            id: meetingID
        },
        dataType: "json",
        success: function ( json )
        {
            //to do later
        }
    });
}


/* used to add the details of a particular meeting to a HTML form, for editing meetings
    @param meetingID the unique ID assigned to a meeting */

function populateMeetingDetails ( description,  )
{
    //select a form element and assign json data to it
    var element = document.getElementById("course-dropdown");
    element.setAttribute("value", /* json data */);

    var element = document.getElementById("location-dropdown");
    element.setAttribute("value", /* json data */);

    var element = document.getElementById("meeting-datetime");
    element.setAttribute("value", /* json data */);

    var element = document.getElementById("max-buddies");           //note: must not allow user to change this to a value lower than the current # of buddies.
    element.setAttribute("value", /* json data */);

    var element = document.getElementById("meeting-comments");
    element.setAttribute("value", /* json data */);
}

/*
    var meetingDesc = json.description;
            var meetingEndDate = json.endDate;
            var meetingMaxBuddies = json.maxBuddies;
            var meetingBuddies = json.buddies //an array of displayNames
*/