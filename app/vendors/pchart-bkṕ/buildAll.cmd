ECHO OFF
CLS
ECHO Processing all examples
ECHO.
ECHO  [01/25] A simple line chart
 php -q %~dp0Example1.php
ECHO  [02/25] A cubic curve graph
 php -q %~dp0Example2.php
ECHO  [03/25] An overlayed bar graph
 php -q %~dp0Example3.php
ECHO  [04/25] Showing how to draw area
 php -q %~dp0Example4.php
ECHO  [05/25] A limits graph
 php -q %~dp0Example5.php
ECHO  [06/25] A simple filled line graph
 php -q %~dp0Example6.php
ECHO  [07/25] A filled cubic curve graph
 php -q %~dp0Example7.php
ECHO  [08/25] A radar graph
 php -q %~dp0Example8.php
ECHO  [09/25] Showing how to use labels
 php -q %~dp0Example9.php
ECHO  [10/25] A 3D exploded pie graph
 php -q %~dp0Example10.php
ECHO  [11/25] A true bar graph
 php -q %~dp0Example12.php
ECHO  [12/25] A 2D exploded pie graph
 php -q %~dp0Example13.php
ECHO  [13/25] A smooth flat pie graph
 php -q %~dp0Example14.php
ECHO  [14/25] Playing with line style and pictures inclusion
 php -q %~dp0Example15.php
ECHO  [15/25] Importing CSV data
 php -q %~dp0Example16.php
ECHO  [16/25] Playing with axis
 php -q %~dp0Example17.php
ECHO  [17/25] Missing values
 php -q %~dp0Example18.php
ECHO  [18/25] Error reporting
 php -q %~dp0Example19.php
ECHO  [19/25] Stacked bar graph
 php -q %~dp0Example20.php
ECHO  [20/25] Playing with background
 php -q %~dp0Example21.php
ECHO  [21/25] Customizing plot charts
 php -q %~dp0Example22.php
ECHO  [22/25] Playing with background - Bis
 php -q %~dp0Example23.php
ECHO  [23/25] Naked and easy!
 php -q %~dp0Naked.php
ECHO  [24/25] Let's go fast, draw small!
 php -q %~dp0SmallGraph.php
ECHO  [25/25] A Small stacked chart
 php -q %~dp0SmallStacked.php
ECHO.
ECHO Rendering complete!
PAUSE
