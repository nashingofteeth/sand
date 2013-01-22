<?php
if (isset($_POST['ta'])) {
	$length = 5;
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ~-_+';

	if ($string = $_POST['custom']){}

	else {
		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}
	}	

	if (file_exists("$string/index.html")) {
		echo "<script>alert('The custom URL $string already exists :(')</script>";
	}

	else {
		mkdir("$string");
		$myFile = "$string/index.html";
		$fh = fopen($myFile, 'w') or die("Can't open file");
		$a = file_get_contents('http://dl.dropbox.com/u/7984474/instabin/a.html');
		$b = $_POST['ta'];
		$c = file_get_contents('http://dl.dropbox.com/u/7984474/instabin/b.html');
		$stringData = $a . $b . $c;
		fwrite($fh, $stringData);
		fclose($fh);
	
		header("Location: $string");
	}
}
?>
<html>  
    <head>
        <title>Instabin</title>
		<script src="http://dl.dropbox.com/u/7984474/instabin/shortcuts.js"></script>
        <script type="text/javascript"> 
			
            var old = '';
            
            function update() {
            var docObj = window.frames['updateFrame'].document;
            var textarea = document.getElementById("ta");
            
            if(old != textarea.value) {
            old = textarea.value;
            docObj.open();
            docObj.write(old);
            docObj.close();
            }
            window.setTimeout(update, 150)
            }
			
			Count=0
            timer=""
            function Set_Count_Mouse() {
            clearTimeout(timer)
            Count++
            timer=setTimeout("Check_Count_Mouse()",300)
            }
            function Check_Count_Mouse() {
            if(Count==4) {
            click()
            }
			if(Count==5) {
            click3()
            }
            Count=0
            }
			
            function click() {
            document.getElementById('updateFrame').style.width = '99.9%';
            show('updateFrame');
            hide('ta');
            show('fullscreenOff');
            }
            function click2() {
            show('ta');
			show('updateFrame');
            document.getElementById('updateFrame').style.width = '60%';
            document.getElementById('ta').style.width = '39.7%';
            hide('fullscreenOff');
            }
            function click3() {
            document.getElementById('ta').style.width = '99.9%';
            show('ta');
            hide('updateFrame');
            show('fullscreenOff');
            }
			function help() {
			window.location = 'http://mtthw.me/instabin/help.html'
			}
            
            function hide(d) { document.getElementById(d).style.display = "none"; }
            function show(d) { document.getElementById(d).style.display = "inline"; }
			
			var cookie = "value";
			function push() {
			    var cookie = document.getElementById('text').value;
			    document.getElementById('ta').value = window.localStorage.getItem(cookie);
			}

			function save() {
			    var cookie = document.getElementById('text').value;
			    window.localStorage.setItem(cookie, document.getElementById('ta').value);
			}
			
			
			shortcut.add("Ctrl+Alt+S",function() {

            document.code.submit();

            });
			shortcut.add("Esc",function() {

            click2();

            });
        </script> 
        <style type="text/css"> 
            html, body, iframe { margin:0; padding:0; height:99.9%; }
            #ta {
            float: right;
            //background: #f9f9f9;
			background-color: #111;
			color: green;
            border: 1px solid #999;
            display: block;
            width: 39.7%;
            height: 100.4%;
            }
            #ta:focus {outline:0; outline:none;}
            #updateFrame {
            float: left;
            padding: 0;
            border: 1px solid #999;
            display: block;
            width: 60%;
			border: none;
            }
            #ta-log {
            position:absolute;
            bottom: 5px;
            right: 5px;
            font-size: 12px;
            }
			#fullscreenOff {
			position: absolute;
			top: 5px;
			right: 5px;
            font-size: 10px;
            font-family: monospace;
            cursor: pointer;
            padding: 5px;
			display: inline;
			color: red;
            margin: -5px -5px -5px -5px;
			display: none;
            }
			#fullscreenOff:active {
			color: darkred;
			}
			#footer {
			font-size: 10px;
			font-family: monospace;
			position: fixed;
			bottom: 5px;
			left: 3px;
			}
        </style> 
    </head> 
    <body id="body" onload="update(); push();"> 
        <div id="fullscreenOff" onclick="click2()">X</div>
        <iframe src="javascript:''" height="100%" width="100%" name="updateFrame" id="updateFrame"></iframe> 
        <form name="code" method="post">
			<textarea onclick="Set_Count_Mouse();" onkeyup="save()" height="100%" width="100%" autofocus name="ta" id="ta" placeholder="Type your HTML here..."></textarea>
			<div id="footer">
				<input placeholder="Project..." title="Project" id="text" type="text" onkeyup="push()" style="font-size: 10px;"/> |
				<input placeholder="Custom URL..." title="Custom URL" onchange="document.code.submit();" id="custom" style="font-size: 10px;" type="text" name="custom"/> |
				<a href="http://mtthw.me/instabin/help.html">?</a>
			</div>
		</form>
        <script type="text/javascript"> 
            (function() {
            
            try {
            (window.localStorage.getItem) // will throw in Firefox under some settings
            } catch (e) {
            return; // quit because dom.storage.enabled is false
            }
            
            var area = document.querySelector('#text');
            // place content from previous edit
            if (!area.value) {
            area.value = window.localStorage.getItem('project');
            }
            
            // your content will be saved locally
            document.querySelector('#text').addEventListener('keyup', function() {
            window.localStorage.setItem('project', area.value);
            }, false);
            })();
        </script> 
        <script type="text/javascript"> 
            function resizeTextArea() {
            var heightOfForm = document.getElementById('fromWrapper').offsetHeight;
            var heightOfBody = document.body.clientHeight;
            var buffer = 35;
            document.getElementById('ta').style.height = (heightOfBody - heightOfForm) - buffer;
            }
        </script> 
    </body> 
</html> 