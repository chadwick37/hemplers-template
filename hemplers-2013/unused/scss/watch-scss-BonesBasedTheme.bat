rem SCSS Watch for themes based off the Bones Wordpress template
rem by Philip Tillsley
rem
rem Last updated: 2012-11-09
rem
rem Usage: Place in the root of the theme
rem 
rem Notes:
rem ** http://themble.com/bones/
rem ** Don't forget to update sass gem first
rem ** You may want to add theme folder to path and move this file outside to avoid accidental upload

rem ** 2013-01-15 moved this up out of the theme folder but the paths will need to be changed for each new theme

rem Development Version (comment when ready to create a compressed file)
sass --watch bcs/library/scss:bcs/library/css --style expanded --debug-info

rem Final Compressed Version (uncomment when ready and run again)
rem sass --watch bcs/library/scss:bcs/library/css --style compressed --debug-info
