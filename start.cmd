@echo off
TITLE 坊主が野原でサバを蒸す
cd /d %~dp0
if exist bin\php\php.exe (
	set PHP_BINARY=bin\php\php.exe
) else (
	set PHP_BINARY=php
)


	if exist BOWZU.php (
		set BOWZU_FILE=BOWZU.php
	) else (
		echo "Couldn't find a valid BOWZU installation"
		pause
		exit 1
	)

#if exist bin\php\php_wxwidgets.dll (
#	%PHP_BINARY% %BOWZU_FILE% --enable-gui %*
#) else (
	if exist bin\mintty.exe (
		start "" bin\mintty.exe -o Columns=88 -o Rows=32 -o AllowBlinking=0 -o FontQuality=3 -o Font="Lucida Sans Typewriter" -o FontHeight=16 -o CursorType=0 -o CursorBlinks=1 -h error -t "坊主が野原でサバを蒸す" -w max %PHP_BINARY% %BOWZU_FILE% --enable-ansi %*
	) else (
		%PHP_BINARY% -c bin\php %BOWZU_FILE% %*
	)
#)
