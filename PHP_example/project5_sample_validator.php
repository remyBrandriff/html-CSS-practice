<!DOCTYPE html>
<?php
/* Validate Email Form
 * This is the PHP file that validates entry from a simple email form.  If any
 * field fails validation, then the form is redisplayed with an error.
 *
 * This is a crippled version of the one I showed in class.  It would make a
 * good starting point.  Even so, DO NOT USE my code.  Pick your own variable
 * names (for keys and values, too) and make up your own CSS (or, better still,
 * use the CSS you came up with for your Project 3, but invoke the external
 * CSS with a PHP echo statement, and any page specific stuff should be your
 * own, not what you see below.
 *
 * Author: Patrick E. Kelley - 2012
 */
?>
<html>
    <head>
        <title>Example Email Form</title>
        <style type ="text/css">
        <!--
            form {margin: 1.5em 0 0 0; padding: 0;}
            .field {padding-top: .5em}
            label {font-weight: bold; float: left; width: 20%;
                   margin-right: 1em; text-align: right;}
            #submit {margin-left: 35%; padding-top: 1em;}
        -->
        </style>
    </head>

    <body>
        <?php
        /* set up array for POST inputs */
        /* not in heading like before, though you could */
        $labels = array("name" => "Your name",
                        "address" => "Your email address",
                        "type" => "Email category");
        /* set a valid flag true */
        $vflag = 1;

        /* scan the POST array and validate the fields */
        foreach ($_POST as $field => $value) {
            /* handle free-form text fields */
            if ($field === "name") {
                if(empty($value)){
                    echo"You must fill in the ($labels[$field]) field.<br>\n";
                    /* set valid flag to false */
                    $vflag = false;
                }
            }

            /* handle email address format */
            if ($field === "address") {
                if(empty($value)){
                    echo"You must fill in the ($labels[$field]) field.<br>\n";
                    /* set valid flag to false */
                    $vflag = false;
                }
                /* you didn't really think I'd give you the pattern? */
                elseif (!eregi('^[a-zA-Z0-9_-.]+@[a-zA-Z0-9-]+.[com|edu|gov]+$', $email)) {
                    echo "Email address must be in the form
                        <i>username@hostname.(com|org|edu|gov)</i>.<br>\n";
                    /* set valid flag to false */
                    $vflag = false;
                }
            }
        }

        /* if we got here and the valid flag is still true, do what the form
         * requires.  Otherwise, redisplay the form for the user to try again.
         */
        if (vflag)  /* if true, do the action (email in this case)... */
            echo "I'd be doing something good here if only the code existed.";
        else /* false, so redisplay form */
        {
            /* $_SERVER(PHP_SELF) means 'use this file on SUBMIT' */
            echo "<h3>Please fill out the form and click submit to send an email.
                </h3>\n
                <form action='$_SERVER[PHP_SELF]' method='POST'>";

            /* Loop that displays the form fields */
            foreach ($labels as $field => $label) {
                  /* echo the label */
                  echo "<div class='field'>\n
                          <label for='$field'>$label</label>\n";

                  /* echo the appropriate field */
                  if ($field === "name" or $field === "address") {
                      echo "<input type='text' name='$field' id='$field'
                            size='65' maxlength='65' value='$_POST[$field]' />\n";
                  }

                  /* echo the end of the field div */
                  echo "</div>\n";
              }

              /* Display the submit button */
              echo "<div id='submit'>\n
                      <input type='submit' value='Send Message'>\n
                    </div>
                </form>";
        }
        ?>
    </body>
</html>
