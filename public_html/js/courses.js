/* Fetch user course list from server
    @param ajax_URL the URI location where the ajax folder is located */

function getUserCourses( ajax_URL )
{
    $.ajax
    ({
        url: ajax_URL + 'courses/user-courses.php',
        data:
        {
            method: "get-courses"
        },
        dataType: "json",
        success: function ( json )
        {
            var courseArray = json;
            for ( var i = 0 ; i < courseArray.length ; i++ )
            {
                var courseID = courseArray[i].id;
                var courseTitle = courseArray[i].title; 

                //calls a separate function to add this data to the HTML
                addToUserCourses(courseID, courseTitle);
            }
        }
    });
}


/* Adds course data to list elements in HTML 
    @param id the 4-letter and 4-number course code
    @param title a brief description / the name of the course*/
function addToUserCourses ( id, title )
{
    /*
    var list = getElementById( 'my-courses-list' );
    var listItem = document.createElmeent('li');

    //create inner anchor element in list item and set its attribute and data
    var anchor = document.createElement('a');
    anchor.setAttribute('href', '#');
    anchor.innerHTML='' + id + '<br/>' + title;

    //put the anchor element inside the list item element
    listItem.innerHTML = anchor;

    //ASSIGN A id="my-courseID" to each list item made for easier removal with the removal helper function
    listItem.setAttribute('id', 'my-' + id);
    */
}

var allCoursesServerResponse = {};
/* Fetch master course list from the server
    @param ajax_URL the URI location where the ajax folder is located */
function getCourseList( ajax_URL )
{
    $.ajax
    ({
        url: ajax_URL + 'courses/courses.php',
        data:
        {
            method: "get-courses"
        },
        dataType: "json",
        success: function (json) {
            for (var i = 0; i < json.length; i++) {
                allCoursesServerResponse[json[i].id] = { 'title':json[i].title, 'inCourse':json[i].inCourse };


                //calls a separate function to add this data to the HTML
                masterCourseListAdd(ajax_URL, json[i].id, json[i].title, json[i].inCourse);
            }
        }
    });
    $( '#all-courses-list' ).listview( 'refresh' );
}

var clearing = false;
var loading = {};
/* Adds course data to list elements in HTML 
    @param id the 4-letter and 4-number course code
    @param title a brief description / the name of the course
    @param inCourse boolean, true if the user in the course*/
function masterCourseListAdd ( ajax_URL, id, title, inCourse )
{
    loading[id] = false;
    var newLI = document.createElement('li');
    newLI.innerHTML = '<a href="#" id="all-course-' + id + '" class="ui-btn" style="vertical-align: middle;">' + id + '<br>' + 
                      title + '</a>';
    allCoursesList.appendChild(newLI);
    if( inCourse )
    {
        newLI.setAttribute( 'data-icon', 'check');
        $('#all-course-' + id).addClass('ui-icon-check ui-btn-icon-right');
    }
    else
    {
        newLI.setAttribute( 'data-icon', 'false');
        $('#all-course-' + id).removeClass('ui-icon-check ui-btn-icon-right');
    }
    
    // Add Event Handler to added List Item
    $('#all-course-' + id).on('click tap', function (e)
    {
        if( loading[id] || clearing )
        {
            return;
        }
        else
        {
            loading[id] = true;
        }
        //show loading image
        e.target.innerHTML = e.target.innerHTML + '<img class="course-loading" src="css/images/ajax-loader.gif" alt="loading...">';

        var parentLI = e.target.parentNode;
        var inUserList = parentLI.getAttribute('data-icon') == 'check';

        parentLI.setAttribute('data-icon', 'false')
        $('#' + e.target.id).removeClass('ui-icon-check ui-btn-icon-right');

        $.post(ajax_URL + 'courses/user-courses.php',
        {
            method: (inUserList ? "remove-course" : "add-course"),
            id: e.target.id.substring(11)
        },
        function (result)
        {
            if (result.success)
            {
                if( inUserList )
                {
                    parentLI.setAttribute('data-icon', 'false')
                    $('#' + e.target.id).removeClass('ui-icon-check ui-btn-icon-right');
                }
                else
                {
                    parentLI.setAttribute('data-icon', 'check')
                    $('#' + e.target.id).addClass('ui-icon-check ui-btn-icon-right');
                }
            }
            //remove loading image
            e.target.removeChild(e.target.getElementsByTagName("img")[0]);
            var refresh = true;
            for( var key in loading )
            {
                if( loading[key] )
                {
                    refresh = false;
                    break;
                }
            }
            if( refresh )
                $('#all-courses-list').listview('refresh');
            loading[id] = false;
        },
        "json");
    });
}

/* Add a course to the master course list
    @param ajax_URL the URI location where the ajax folder is located
    @param courseID the 4-letter and 4-number course code
    @param description a brief description / the name of the course */
function createCourse( ajax_URL, courseID, description )
{
    $.ajax
        ({
            url: ajax_URL + 'courses/courses.php',
            data:
            {
                method: "add-course",
                id: courseID,
                title: description
            },
            dataType: "json",
            success: function (json) {
                var courseID = json.id;
                var description = json.title;
                var inCourse = true;
                
                if(json.success == true){
                    document.getElementById("user-course-form").reset();
                    $.mobile.changePage("#page-all-courses");
                }
            }
        });
}

/* adds a course to the user list in the database
    @param ajax_URL the URI location where the ajax folder is located
    @param courseID the 4-letter and 4-number course code */
function addUserCourse( ajax_URL, courseID )
{
    $.ajax
    ({
        url: ajax_URL + 'courses/user-courses.php',
        data:
        {
            method: "add-course",
            id: courseID
        },
        dataType: "json",
        success: function ( json )
        {
            var courseID = json.id;
			var description = json.title;
			
			/* helper function, adds the course to the HTML */
			addToUserCourses (courseID, description);
        }
    });

}

/* removes a course from the user list in the database
    @param ajax_URL the URI location where the ajax folder is located
    @param courseID the 4-letter and 4-number course code */
function removeUserCourse ( ajax_URL, courseID )
{
    $.ajax
    ({
        url: ajax_URL + 'courses/user-courses.php',
        data:
        {
            method: "remove-course",
            id: courseID
        },
        datatype: "json",
        success: function ( json )
        {
            var CourseID = json.id;
			
			/* helper function called to remove HTML elements referencing this course */
			removeFromUserCourses ( id );
        }
    });
}

/* helper function. Removes list elements in HTML
	@param courseID the 4-letter and 4-number course code
    @param mode valid entries are 'my' or 'master
        my: specifies removal from an individual user course list
        master: specifies removal from the master course list */
function removeFromUserCourses ( courseID, mode )
{
    var element = getElementById( '' + mode + '-' + CourseID );
    element.parentNode.removeChild( element );
}

/* toggle course watch visibility 
    @param ajax_URL the URI location where the ajax folder is located
    @param courseID the 4-letter and 4-number course code */
function toggleVisibility ( ajax_URL, courseID )
{
    $.ajax
    ({
        url: ajax_URL + 'courses/user-courses.php',
        data:
        {
            method: "toggle-visibility",
            id: courseID
        },
        datatype: "json",
        success: function ( json )
        {
            //PLACEHOLDER, backklog for next sprint
        }
    });
}