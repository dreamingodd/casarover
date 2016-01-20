REM 1.edit this batch and change the path and project folder name first.
set projectFolder=C:\wamp\www\
set projectName=casarover
set HOME_7Z=C:\Program Files\7-Zip
set projectPath=%projectFolder%%projectName%
echo Project Path: %projectPath%
REM 2.copy files and delete useless files.
cd %projectFolder%
REM ----If there's a choice to make, choose Directory
mkdir %projectName%_temp
xcopy /s/e %projectName% %projectName%_temp
del %projectName%_temp\.*
rd /s/q %projectName%_temp\tests
rd /s/q %projectName%_temp\docs
rd /s/q %projectName%_temp\website\less
if exist %projectName%_temp\.settings rd /s/q %projectName%_temp\.settings
if exist %projectName%_temp\.svn rd /s/q %projectName%_temp\.svn
REM 3.compress folder using 7z.
if exist %projectName%.zip del %projectName%.zip
cd %HOME_7Z%
7z a -tzip %projectPath%.zip %projectPath%_temp
REM 4.delete temp file.
rd /s/q %projectPath%_temp
cd %projectFolder%
pause

