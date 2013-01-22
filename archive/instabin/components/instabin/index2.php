<?php
if (isset($_POST['ta'])) {
	$length = 5;
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

	if ($string = $_POST['custom']){}

	else {
		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}
	}	

	if (file_exists("d/$string/index.html")) {
		echo "$string already exists";
	}

	else {
		mkdir("d/$string", 0700);
		$myFile = "d/$string/index.html";
		$fh = fopen($myFile, 'w') or die("Can't open file");
		$stringData = $_POST['ta'];
		fwrite($fh, $stringData);
		fclose($fh);
	
		header("Location: d/$string");
	}
}
?>

<html> 
    <head> 
        <title>Instabin</title>
        <link href="favicon.ico" rel="Shortcut Icon" /> 
        <meta name="author" content="Matthew Nash - http://mtthw.me"> 
        <script src="http://htmlbin.com/js/codemirror.js" type="text/javascript"></script>
        <script type="text/javascript"> 
            var old = '';
            
            function update() {
            var docObj = window.frames['updateFrame'].document;
            var textarea = document.getElementById("code");
            
            if(old != textarea.value) {
            old = textarea.value;
            docObj.open();
            docObj.write(old);
            docObj.close();
            }
            window.setTimeout(update, 150)
            }s
            
            
            Count=0
            timer=""
            function Set_Count() {
            clearTimeout(timer)
            Count++
            timer=setTimeout("Check_Count()",300)
            }
            function Check_Count() {
            if(Count==4) {
            click()
            }
            Count=0
            }
            function click() {
            document.getElementById('updateFrame').style.width = '99.8%';
            document.getElementById('code').style.display = 'none';
            document.getElementById('fullscreenOff').style.display = 'block';
            }
        </script> 
        <style type="text/css"> 
            html, body, iframe { margin:0; padding:0; height:99.9%; }
            #code {
            float: right;
            background: #eaefff;
            border: 1px solid #999;
            display: block;
            width: 39.7%;
            height: 99.9%;
            font-family: monospace;
            }
            #code:focus {
            outline:0;
            outline:none;
            }
            #updateFrame {
            float: left;
            padding: 0;
            border: 1px solid #999;
            display: block;
            width: 60%;
            }
            #ta-log {
            position:absolute;
            bottom: 5px;
            right: 5px;
            font-size: 10px;
            }
            #ta-log:hover {
            display: none;
            }
            #fullscreenOff {
            display: none;
            position: absolute;
            top: 5px;
            right: 5px;
            cursor: pointer;
            color: blue;
            text-decoration: underline;
            font-size: 15px;
            }
            #fullscreenOff:active {
            color: red;
            }
            .CodeMirror-line-numbers {
            width: 2.2em;
            color: #aaa;
            background-color: #eee;
            text-align: right;
            padding-right: .3em;
            font-size: 10pt;
            font-family: monospace;
            padding-top: .4em;
            }
			.Codemirror-wrapping {
			float: right;
			}
        </style> 
    </head> 
    <body id="body" onload="update();"> 
        <div id="fullscreenOff" onclick="document.getElementById('updateFrame').style.width = '60%';
        document.getElementById('code').style.display = 'block';
        document.getElementById('fullscreenOff').style.display = 'none';">Exit Fullscreen</div> 
        <div id="frame" style="cursor: pointer;"> 
            <iframe src="javascript:''" height="150%" width="100%" name="updateFrame" id="updateFrame"></iframe> 
        </div>
        <form method="post">
            <?php
			if (isset($_GET['url'])) {
				echo "<script>document.getElementById('code').value = ''; window.localStorage.setItem('value', area.value); window.localStorage.setItem('timestamp', (new Date()).getTime()); updateLog(true);</script><textarea onkeyup='update()' onclick='Set_Count()' height='100%' width='100%' autofocus required name='ta' wrap='hard' spellcheck='false' id='code' placeholder='Type your HTML here...'>";
				echo file_get_contents($_GET['url']);
				echo "</textarea>";
			}
			else {
				echo "<textarea onkeyup='update()' onclick='Set_Count()' height='100%' width='100%' autofocus required name='ta' wrap='hard' spellcheck='false' id='code' placeholder='Type your HTML here...'></textarea>";
            }
			?>
			<div style="position: absolute; bottom: 3px; left: 3px;">
                <input style="float: left;" type="submit" value="Save">
                <a href="#" id="custLink" style="float: left; font-size: 10px;" onclick="document.getElementById('custom').style.display = 'block';document.getElementById('custLink').style.display = 'none';">[Custom URL]</a>
                <input autofocus id="custom" onBlur="document.getElementById('custom').style.display = 'none';document.getElementById('custLink').style.display = 'block';" style="display: none; font-size: 10px; float: left;" type="text" name="custom"/>
            </div>
        </form>
		<form style="position: absolute; bottom: -10px; left: 150px;" method="get">
			Open url: <input type="text" name="url" value="http://"/>
		</form>
        <div id="ta-log"></div>
        <script type="text/javascript"> 
            (function() {
            
            
            try {
            
            (window.localStorage.getItem) // will throw in Firefox under some settings
            } catch (e) {
            
            return; // quit because dom.storage.enabled is false
            }
            
            
            
            var area = document.querySelector('#code');
            
            // place content from previous edit
            if (!area.value) {
            
            area.value = window.localStorage.getItem('value');
            
            }
            
            updateLog(false);
            
            
            
            // your content will be saved locally
            document.querySelector('#code').addEventListener('keyup', function() {
            
            window.localStorage.setItem('value', area.value);
            
            window.localStorage.setItem('timestamp', (new Date()).getTime());
            
            updateLog(true);
            
            }, false);
            
            
            
            function updateLog(new_save) {
            
            var log = document.querySelector("#ta-log");
            
            var delta = 0;
            
            if (window.localStorage.getItem('value')) {
            
            delta = ((new Date()).getTime() - (new Date()).setTime(window.localStorage.getItem('timestamp'))) / 1000;
            
            if (new_save) {
            
            log.textContent = '';
            
            setTimeout(function() {
            
            log.textContent = '';
            
            }, 30000);
            
            } else {
            
            log.textContent = 'last edit: ' + delta + 's ago';
            
            }
            
            }
            
            }
            
            
            
            })();
            
        </script> 
    </body> 
</html>