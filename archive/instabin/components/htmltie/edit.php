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
		echo "<script>alert('The custom URL $string already exists')</script>";
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
        <script>

shortcut = {

    'all_shortcuts':{},//All the shortcuts are stored in this array

	'add': function(shortcut_combination,callback,opt) {

		//Provide a set of default options

		var default_options = {

			'type':'keydown',

			'propagate':false,

			'disable_in_input':false,

			'target':document,

			'keycode':false

		}

		if(!opt) opt = default_options;

		else {

			for(var dfo in default_options) {

				if(typeof opt[dfo] == 'undefined') opt[dfo] = default_options[dfo];

			}

		}



		var ele = opt.target;

		if(typeof opt.target == 'string') ele = document.getElementById(opt.target);

		var ths = this;

		shortcut_combination = shortcut_combination.toLowerCase();



		//The function to be called at keypress

		var func = function(e) {

			e = e || window.event;

			

			if(opt['disable_in_input']) { //Don't enable shortcut keys in Input, Textarea fields

				var element;

				if(e.target) element=e.target;

				else if(e.srcElement) element=e.srcElement;

				if(element.nodeType==3) element=element.parentNode;



				if(element.tagName == 'INPUT' || element.tagName == 'TEXTAREA') return;

			}

	

			//Find Which key is pressed

			if (e.keyCode) code = e.keyCode;

			else if (e.which) code = e.which;

			var character = String.fromCharCode(code).toLowerCase();

			

			if(code == 188) character=","; //If the user presses , when the type is onkeydown

			if(code == 190) character="."; //If the user presses , when the type is onkeydown



			var keys = shortcut_combination.split("+");

			//Key Pressed - counts the number of valid keypresses - if it is same as the number of keys, the shortcut function is invoked

			var kp = 0;

			

			//Work around for stupid Shift key bug created by using lowercase - as a result the shift+num combination was broken

			var shift_nums = {

				"`":"~",

				"1":"!",

				"2":"@",

				"3":"#",

				"4":"$",

				"5":"%",

				"6":"^",

				"7":"&",

				"8":"*",

				"9":"(",

				"0":")",

				"-":"_",

				"=":"+",

				";":":",

				"'":"\"",

				",":"<",

				".":">",

				"/":"?",

				"\\":"|"

			}

			//Special Keys - and their codes

			var special_keys = {

				'esc':27,

				'escape':27,

				'tab':9,

				'space':32,

				'return':13,

				'enter':13,

				'backspace':8,

	

				'scrolllock':145,

				'scroll_lock':145,

				'scroll':145,

				'capslock':20,

				'caps_lock':20,

				'caps':20,

				'numlock':144,

				'num_lock':144,

				'num':144,

				

				'pause':19,

				'break':19,

				

				'insert':45,

				'home':36,

				'delete':46,

				'end':35,

				

				'pageup':33,

				'page_up':33,

				'pu':33,

	

				'pagedown':34,

				'page_down':34,

				'pd':34,

	

				'left':37,

				'up':38,

				'right':39,

				'down':40,

	

				'f1':112,

				'f2':113,

				'f3':114,

				'f4':115,

				'f5':116,

				'f6':117,

				'f7':118,

				'f8':119,

				'f9':120,

				'f10':121,

				'f11':122,

				'f12':123

			}

	

			var modifiers = { 

				shift: { wanted:false, pressed:false},

				ctrl : { wanted:false, pressed:false},

				alt  : { wanted:false, pressed:false},

				meta : { wanted:false, pressed:false}	//Meta is Mac specific

			};

                        

			if(e.ctrlKey)	modifiers.ctrl.pressed = true;

			if(e.shiftKey)	modifiers.shift.pressed = true;

			if(e.altKey)	modifiers.alt.pressed = true;

			if(e.metaKey)   modifiers.meta.pressed = true;

                        

			for(var i=0; k=keys[i],i<keys.length; i++) {

				//Modifiers

				if(k == 'ctrl' || k == 'control') {

					kp++;

					modifiers.ctrl.wanted = true;



				} else if(k == 'shift') {

					kp++;

					modifiers.shift.wanted = true;



				} else if(k == 'alt') {

					kp++;

					modifiers.alt.wanted = true;

				} else if(k == 'meta') {

					kp++;

					modifiers.meta.wanted = true;

				} else if(k.length > 1) { //If it is a special key

					if(special_keys[k] == code) kp++;

					

				} else if(opt['keycode']) {

					if(opt['keycode'] == code) kp++;



				} else { //The special keys did not match

					if(character == k) kp++;

					else {

						if(shift_nums[character] && e.shiftKey) { //Stupid Shift key bug created by using lowercase

							character = shift_nums[character]; 

							if(character == k) kp++;

						}

					}

				}

			}

			

			if(kp == keys.length && 

						modifiers.ctrl.pressed == modifiers.ctrl.wanted &&

						modifiers.shift.pressed == modifiers.shift.wanted &&

						modifiers.alt.pressed == modifiers.alt.wanted &&

						modifiers.meta.pressed == modifiers.meta.wanted) {

				callback(e);

	

				if(!opt['propagate']) { //Stop the event

					//e.cancelBubble is supported by IE - this will kill the bubbling process.

					e.cancelBubble = true;

					e.returnValue = false;

	

					//e.stopPropagation works in Firefox.

					if (e.stopPropagation) {

						e.stopPropagation();

						e.preventDefault();

					}

					return false;

				}

			}

		}

		this.all_shortcuts[shortcut_combination] = {

			'callback':func, 

			'target':ele, 

			'event': opt['type']

		};

		//Attach the function with the event

		if(ele.addEventListener) ele.addEventListener(opt['type'], func, false);

		else if(ele.attachEvent) ele.attachEvent('on'+opt['type'], func);

		else ele['on'+opt['type']] = func;

	},



	//Remove the shortcut - just specify the shortcut and I will remove the binding

	'remove':function(shortcut_combination) {

		shortcut_combination = shortcut_combination.toLowerCase();

		var binding = this.all_shortcuts[shortcut_combination];

		delete(this.all_shortcuts[shortcut_combination])

		if(!binding) return;

		var type = binding['event'];

		var ele = binding['target'];

		var callback = binding['callback'];



		if(ele.detachEvent) ele.detachEvent('on'+type, callback);

		else if(ele.removeEventListener) ele.removeEventListener(type, callback, false);

		else ele['on'+type] = false;

	}

}

        </script>

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

            preview()

            }
			
			if(Count==5) {

            var url = prompt("Open URL:", "http://");
			location.replace('?url='+url);

            }

            Count=0

            }


            function preview() {

            document.getElementById('updateFrame').style.width = '99.9%';

			document.getElementById('code').style.width = '0%';
			
			document.getElementById('updateFrame').style.display = 'inline';
			
            document.getElementById('code').style.display = 'none';

            document.getElementById('fullscreenOff').style.display = 'inline';

            }

            function split() {

            document.getElementById('updateFrame').style.width = '60%';
			
			document.getElementById('code').style.width = '39.7%';
			
			document.getElementById('updateFrame').style.display = 'inline';

            document.getElementById('code').style.display = 'inline';

            document.getElementById('fullscreenOff').style.display = 'none';

            }
			
			function code() {

            document.getElementById('code').style.width = '99.9%';
			
			document.getElementById('updateFrame').style.width = '0%';

            document.getElementById('updateFrame').style.display = 'none';
			
			document.getElementById('code').style.display = 'inline';

            document.getElementById('fullscreenOff').style.display = 'inline';

            }
			
			function help() {
			alert('Save: Ctrl+Alt+S   Open URL: Ctrl+Alt+O or click textbox 5 times.   FULLSCREEN: Ctrl+Alt+P or click the textbox 4 times.   EXIT FULLSCREEN: Esc or click the Exit Fullscreen.   HELP: Ctrl+Alt+H');
            }
			
			shortcut.add("Ctrl+Alt+P",function() {

            preview()

            });
			
			shortcut.add("Ctrl+Alt+S",function() {

            document.code.submit();

            });
			
			shortcut.add("Ctrl+Alt+C",function() {

            code()

            });
			
            shortcut.add("Esc",function() {

            split()

            });
			
			shortcut.add("Ctrl+Alt+O",function() {
			
			var url = prompt("Open URL:", "http://");
			location.replace('?url='+url);
			
			});

            shortcut.add("Ctrl+Alt+H",function() {

            help()

            });

            function hotkey(TA,id) {

            shortcut.add("Ctrl",function() {

            window.localStorage.setItem('value'+id, document.getElementById('ta'+id).value);

            window.localStorage.setItem('timestamp', (new Date()).getTime());

            updateLog(true,id);

            });

            }

        </script> 
        <style type="text/css"> 
            html, body, iframe { margin:0; padding:0; height:99.9%;}
            #code {
            float: right;
            background: #f9fafc;
            border: 1px solid #999;
            display: block;
            width: 39.7%;
            height: 100.3%;
            font-family: monospace;
            }
			a {
			color: black;
			}
			a:hover {
			text-decoration: none;
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
			display: none;
            }
            #ta-log:hover {
            display: none;
            }
			
            #fullscreenOff {
            display: none;
            position: absolute;
            top: 5px;
            right: 5px;
            font-size: 10px;
            font-family: arial;
            cursor: pointer;
            padding: 5px;
            border-bottom: 1px dotted grey;
            border-left: 1px dotted grey;
            margin: -5px -5px -5px -5px;
            -webkit-border-bottom-left-radius: 5px;
			background-color: white;
            }
            #fullscreenOff:active {
            color: red;
            }
			#footer {
			-webkit-transition:All .3s ease;
			opacity: .3;
			position: absolute;
			bottom: 5px;
			left: 5px;
            font-size: 10px;
            font-family: arial;
            cursor: pointer;
            padding: 5px;
            border-top: 1px dotted grey;
            border-right: 1px dotted grey;
            margin: -5px -5px -5px -5px;
            -webkit-border-top-right-radius: 5px;
			background-color: white;
			}
			#footer:hover {
			opacity: 1;
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
    <body id="body" onload="update()"> 
        <div id="fullscreenOff" onclick="split()">Exit Fullscreen</div> 
        <div id="frame" style="cursor: pointer;"> 
            <iframe id="updateFrame" src="javascript:''" height="150%" width="100%" name="updateFrame"></iframe> 
        </div>
        <form name="code" method="post">
            <?php
			if (isset($_GET['url'])) {
				echo "<script>document.getElementById('code').value = ''; window.localStorage.setItem('value', area.value); window.localStorage.setItem('timestamp', (new Date()).getTime()); updateLog(true);</script><textarea id='code' onkeyup='update()' onclick='Set_Count_Mouse()' height='100%' width='100%' autofocus required name='ta' wrap='hard' spellcheck='false' id='code' placeholder='Type your HTML here...'>";
				echo file_get_contents($_GET['url']);
				echo "</textarea>";
			}
			else {
				echo "<textarea id='code' onkeyup='update()' onclick='Set_Count_Mouse()' height='100%' width='100%' autofocus required name='ta' wrap='hard' spellcheck='false' id='code' placeholder='Type your HTML here...'></textarea>";
            }
			?>
			<div id="footer">
				<a href="index.php"><a href="home.php">Home</a> | <a href="javascript: help()">Hotkeys</a>
				<input placeholder="Custom URL..." id="custom" style="font-size: 10px; margin-left: 10px;" type="text" name="custom"/>
			</div>
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