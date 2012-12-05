<?php
if (isset($_GET['c'])) {
$c = $_GET['c'];
}
else {
$c = "new";
}
?>
<html>
<!-- _  _ ___ _  _ _    ___ _ ____ -->
<!-- |__|  |  |\/| |     |  | |___ -->
<!-- |  |  |  |  | |___  |  | |___ -->
<!--           By MTTHW.me         -->    
    <head>
        <title><?php echo $c;?> - HTMLTIE</title>
		<link href="http://dl.dropbox.com/u/7984474/ht/favicon.ico" rel="Shortcut Icon" />
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
            Count=0
            }
			
            function click() {
            document.getElementById('updateFrame').style.width = '99.9%';
            hide('ta');
            show('fullscreenOff');
            }
            function click2() {
            document.getElementById('updateFrame').style.width = '60%';
            show('ta');
            hide('fullscreenOff');
            }
			function help() {
			alert('1. Clicking on the textarea 4 times quickly will switch to fullscreen.   2. Typing "+/?c=example" after the url will create a new cookie.');
			}
            
            function hide(d) { document.getElementById(d).style.display = "none"; }
            function show(d) { document.getElementById(d).style.display = "inline"; }
        </script> 
        <style type="text/css"> 
            html, body, iframe { margin:0; padding:0; height:99.9%; }
            #ta {
            float: right;
            background: #f4f7ff;
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
            border-bottom: 1px dotted grey;
            border-left: 1px dotted grey;
            margin: -5px -5px -5px -5px;
            -webkit-border-bottom-left-radius: 5px;
			display: none;
            }
			#fullscreenOff:active {
			color: red;
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
    <body id="body" onload="update();"> 
        <div id="fullscreenOff" onclick="click2()">X</div>
        <iframe src="javascript:''" height="100%" width="100%" name="updateFrame" id="updateFrame"></iframe> 
        <textarea onclick="Set_Count_Mouse();" height="100%" width="100%" autofocus name="ta" id="ta" placeholder="Type your HTML here..."></textarea>
		<div id="footer">
        <a href="#" onclick="help()">Help</a> | 
		Created by <a href="http://twitter.com/mtthwn">@mtthwn</a></div>
        <script type="text/javascript"> 
            (function() {
            
            try {
            (window.localStorage.getItem) // will throw in Firefox under some settings
            } catch (e) {
            return; // quit because dom.storage.enabled is false
            }
            
            var area = document.querySelector('#ta');
            // place content from previous edit
            if (!area.value) {
            area.value = window.localStorage.getItem('<?php echo $c;?>');
            }
            
            // your content will be saved locally
            document.querySelector('#ta').addEventListener('keyup', function() {
            window.localStorage.setItem('<?php echo $c;?>', area.value);
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