<html>
      <head>
            <title>
                  Instabin
            </title>
            <script src=
            "http://dl.dropbox.com/u/7984474/projects/instabin/shortcuts.js"
            type="text/javascript"></script>
            <link href=
            'http://fonts.googleapis.com/css?family=Yellowtail'
            rel='stylesheet' type='text/css'>
            <link href=
            'http://dl.dropbox.com/u/7984474/projects/instabin/style.css'
            rel='stylesheet' type='text/css'>
            <link href=
            "http://dl.dropbox.com/u/7984474/projects/instabin/favicon.ico"
            rel="Shortcut Icon">
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
      </head>
      <body id="body" onload="update(); push();">
            <iframe src="javascript:''" height="100%" width="100%"
            name="updateFrame" id="updateFrame"></iframe>
            <form name="code" method="post" action=
            "http://mtthw.me/instabin/save.php">
                  <textarea onclick="Set_Count_Mouse();" onkeyup=
                  "save()" height="100%" width="100%" autofocus=""
                  name="ta" id="ta" placeholder=
                  "Type your HTML here...">
		  </textarea>
            </form>
            <div id="footer">
                  <div onclick=
                  "window.location = 'http://mtthw.me/instabin'"
                  id="head">
                        Instabin!
                  </div><button id="fullscreenOff" onclick=
                  "click2()">X</button>
                  <a href=
                  "http://mtthw.me/instabin/help.html">
                  <button type="submit"
                  onclick="help()" title="Help">?</button></a>
                  <!--<input placeholder="Custom URL..." title="Custom URL" onchange="document.code.submit();" id="custom" style="font-size: 10px;" type="text" name="custom"/>-->
                   <button onclick=
                  "document.code.submit();">Save</button>
                  <input placeholder="Local project..." title=
                  "Project" id="text" type="text" onkeyup=
                  "push()"></button></a>
            </div><script type="text/javascript">

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
            </script><script type="text/javascript">

            function resizeTextArea() {
            var heightOfForm = document.getElementById('fromWrapper').offsetHeight;
            var heightOfBody = document.body.clientHeight;
            var buffer = 35;
            document.getElementById('ta').style.height = (heightOfBody - heightOfForm) - buffer;
            }
            </script>
      </body>
</html>
