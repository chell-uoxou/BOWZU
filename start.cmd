@echo off
TITLE �V�傪�쌴�ŃT�o������
cd /d %~dp0
if exist bin\php\php.exe (
	set PHP_BINARY=bin\php\php.exe
) else (
	set PHP_BINARY=php
)


	if exist �V�傪�쌴�ŃT�o������.php (
		set BOUZU_FILE=�V�傪�쌴�ŃT�o������.php
	) else (
		echo "Couldn't find a valid �V�傪�쌴�ŃT�o������ installation"
		pause
		exit 1
	)

#if exist bin\php\php_wxwidgets.dll (
#	%PHP_BINARY% %BOUZU_FILE% --enable-gui %*
#) else (
	if exist bin\mintty.exe (
		start "" bin\mintty.exe -o Columns=88 -o Rows=32 -o AllowBlinking=0 -o FontQuality=3 -o Font="DejaVu Sans Mono" -o FontHeight=10 -o CursorType=0 -o CursorBlinks=1 -h error -t "�V�傪�쌴�ŃT�o������" -w max %PHP_BINARY% %BOUZU_FILE% --enable-ansi %*
	) else (
		%PHP_BINARY% -c bin\php %BOUZU_FILE% %*
	)
#)
