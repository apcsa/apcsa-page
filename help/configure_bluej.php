<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <link rel="stylesheet" href="installation.css">
      <title>Guide to configuring BlueJ</title>
   </head>
   <body id="installGuide">
      <div id="installContentBox">
         <div id="contentBoxScrollArea">
            <?php 
            require_once ("../../config.php");
            $username = get_username();
            
            function echoSettings() {
                global $username;
                if ($username) {
                    echo "Your user name: <b>".$username."</b> <br> The course URL: <b>".BASE_WWW."</b>";
                } else {
                    echo "You are not logged into Moodle, so your settings can't be determined. ".
                    " If you are taking a Moodle-hosted course, please <a href=\"../../\" target=\"_blank\">log in</a> now, ".
                    "and reload this page.";
                }
            }
            ?>
            <h2>Guide to the initial configuration of BlueJ </h2>
            <p style="border: 2px solid green; margin: 15px 20% 15px 20%;">
               <?php echoSettings(); ?>
            </p>
            <br>
            <p>The <b>UC College Prep AP Computer Science</b> course has tailored the open-source BlueJ 
               development environment in order to help maintain a high quality learning flow,  
               among other benefits. 
               This enhancement allows the student to have a BlueJ project load automatically 
               depending on which page of the course is currently being viewed.</p>
            <p>There are two requirements for this feature to work:</p>
            <ol>
               <li>
                  The student must be taking UC College Prep AP Computer Science via a 
                  Moodle supported server.  That is, this automatic loading feature will not work 
                  with the static (non-server) version of this course.
               </li>
               <li>
                  Information about the student's moodle account name and the server location have to be 
                  stored in BlueJ.  When BlueJ is run for the first time after installation, it will ask for these  
                  values. 
               </li>
            </ol>
            <h4>Setting up BlueJ for the First Time</h4>
            <p>When BlueJ is run for the first time, it will popup a dialog box:</p>
            <br>
            <div class="imageCenter">
               <img src="firstTimeOpenBlueJ.jpg" alt="The dialog box asking for information when BlueJ is run for the first time">
            </div>
            <br>
            <p>You only need to enter values if you are taking a Moodle-hosted course.  If you are, and you have already
               logged in to the course, use the following settings:</p>
            <p style="border: 2px solid green; margin: 15px 20% 15px 20%;">
               <?php echoSettings(); ?>
            </p>
            <br>
            <h4>Editing the BlueJ Settings </h4>
            <p>If you need to change the User name and course URL settings after they have been set, you can 
               do so easily. From within Bluej, you need to open the <b>Preferences...</b> dialog:</p>
            <ul>
               <li>
                  On a Windows PC, open BlueJ's <b>Tools</b>
                  menu and select the <b>Preferences...</b>
                  menu item.
               </li>
               <li>
                  On a Macintosh, open BlueJ's <b>BlueJ</b>
                  menu and select the <b>Preferences...</b>
                  menu item.
               </li>
            </ul>
            <p>Next, move to the <b>Extensions</b> tab at the far right.  The user name and course URL input boxes 
               will be at the bottom of the dialog box.  Change them here. </p>
            <p>There is also a <b>Project Location</b> input box. This is the directory at which all of the <b>UC
                  College Prep AP Computer Science</b> projects have been stored on your local computer.  The course installer
               will place them in this default location.</p>
         </div>
      </div>
      <div id="InfoBoxClose">
         <a href="JavaScript:window.close()">Close</a>
      </div>
   </body>
</html>
