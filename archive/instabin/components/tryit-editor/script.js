window.addEventListener("load", function() {
	document.getElementById("code1").value = localStorage.x || '<!DOCTYPE html>\n<html>\n  <head>\n    <title>Hello World</title>\n    <script type="text/javascript">\n    </script>\n    <style>\n      h1 {\n        text-align: center;\n      }\n    </style>\n  </head>\n  <body>\n    <h1>Hello World!</h1>\n    <p>This is a test page</p>\n  </body>\n</html>';
	if (localStorage.getItem("outputHeight")) {
		document.querySelector("#view").style.height = localStorage.getItem("outputHeight") + "px";
	}
	if (localStorage.getItem("outputWidth")) {
		document.querySelector("#view").style.width = localStorage.getItem("outputWidth") + "%";
	}
	if (localStorage.getItem("disableTitle") == "true") {
		document.getElementById("titletext").style.visibility = "hidden";
	}
	if (localStorage[localStorage.current]) {
		document.querySelector("#code1").value = localStorage[localStorage.current];
	}
	statusline("ready");
	setInterval('if (localStorage.current) { document.getElementById("titletext").innerHTML = " Editing: " + localStorage.current + " Page Title:&nbsp;" + view.document.title;} else { document.getElementById("titletext").innerHTML = "Page Title:&nbsp;" + view.document.title}', 2000);
	codeMirror = CodeMirror.fromTextArea(document.getElementById("code1"), {
		lineNumbers: !0,
		matchBrackets: !0,
		lineWrapping: !0,
		mode: "text/html",
		tabMode: "indent",
		onCursorActivity: function () {
			codeMirror.setLineClass(d, null), d = codeMirror.setLineClass(codeMirror.getCursor().line, "activeline")
		}
	});
	var d = codeMirror.setLineClass(0, "activeline");
	codeMirror.setOption("theme", "eclipse"), startit();
	document.getElementById("code1").addEventListener("keydown", function (e) {
		if (e.keyCode == 9) {
			e.preventDefault();
			var t = e.target;
			var ss = t.selectionStart;
			var se = t.selectionEnd;
			t.value = t.value.slice(0, ss).concat("\t").concat(t.value.slice(ss, t.value.length));
			if (ss == se) {
				t.selectionStart = t.selectionEnd = ss + 1;
			} else {
				t.selectionStart = ss + 1;
				t.selectionEnd = se + 1;
			};
		};
	}, false);
	if (localStorage.getItem("editorWidth")) {
		document.querySelector("#code1").style.width = localStorage.getItem("editorWidth") + "%";
		document.getElementsByClassName("CodeMirror")[0].style.width = localStorage.getItem("editorWidth") + "%";
	}
	if (localStorage.getItem("editorHeight")) {
		document.querySelector("#code1").style.height = localStorage.getItem("editorHeight") + "px";
		document.getElementsByClassName("CodeMirror")[0].style.height = localStorage.getItem("editorHeight") + "px";
	}
	if (localStorage.getItem("useOld") == true || localStorage.getItem("useOld") == "true") {
		document.getElementsByClassName("CodeMirror")[0].style.display = "none";
		document.querySelector("#code1").style.display = "block";
	}
	if (localStorage.getItem("experimental") == "true") {
		document.querySelector("#experimental").style.display = "block";
	}
}, false);
/*window.addEventListener("beforeunload", function() {
	if (localStorage.getItem("useOld")) {
		localStorage.x = document.getElementById("code1").value;
	}
	else {
		localStorage.x = codeMirror.getValue();
	}
}, false);*/
var y, x, xy, xy3, codeMirror, codeMirrorValue;
window.addEventListener("keydown", function (e) {
	if (e.which == 112) {
		e.preventDefault();
		alert("Tryit Editor Chrome Application (1.0.0)\nCopyright © 2012, Kevin Zhou\nAll rights reserved.\n\nThis software is provided by the copyright holders and any express or implied warranties, including, but not limited to, the implied warranties of merchantability and fitness for a particular purpose are disclaimed. In no event shall the copyright owner or contributors be liable for any direct, indirect, incidental, special, exemplary, or consequential damages (including, but not limited to, procurement of substitute goods or services; loss of use, data, or profits; or business interruption) however caused and on any theory of liability, whether in contract, strict liability, or tort (including negligence or otherwise) arising in any way out of the use of this software, even if advised of the possibility of such damage.");
	}
}, false);
function statusline(a, b) {
	document.getElementById("statusline").innerHTML = "<span style='color:" + (b || "#000000") + ";'>" + a + "</span>", window.status = a, document.title = "Tryit Editor v1.5 - " + a
}

function startit() {
	(localStorage.getItem("useOld") == "true") ? (view.document.open(), view.document.write(document.getElementById("code1").value), view.document.close()) : (view.document.open(), view.document.write(codeMirror.getValue()), view.document.close(), document.getElementById("titletext").innerHTML = "Page Title:&nbsp;" + view.document.title);
	if (localStorage.current) {
		document.getElementById("titletext").innerHTML = " Editing: " + localStorage.current + " Page Title:&nbsp;" + view.document.title;
	}
	else {
		document.getElementById("titletext").innerHTML = "Page Title:&nbsp;" + view.document.title;
	}
}

function reset() {
	document.getElementById("code1").value = '<!DOCTYPE html>\n<html>\n  <head>\n    <title>Hello World</title>\n    <script type="text/javascript">\n    </script>\n    <style>\n      h1 {\n        text-align: center;\n      }\n    </style>\n  </head>\n  <body>\n    <h1>Hello World!</h1>\n    <p>This is a test page</p>\n  </body>\n</html>', codeMirror.setValue('<!DOCTYPE html>\n<html>\n  <head>\n    <title>Hello World</title>\n    <script type="text/javascript">\n    </script>\n    <style>\n      h1 {\n        text-align: center;\n      }\n    </style>\n  </head>\n  <body>\n    <h1>Hello World!</h1>\n    <p>This is a test page</p>\n  </body>\n</html>'), statusline("code reset", "green")
}

function save() {
	if (localStorage.useOld.toString() == "true") {
		localStorage[localStorage.current] = document.querySelector("#code1").value;
	}
	else {
		localStorage[localStorage.current] = codeMirror.getValue();
	}
}

function saveAs(key) {
	if (localStorage[key]) {
		if (key != "current" && key != "editorHeight" && key != "editorWidth" && key != "outputHeight" && key != "outputWidth" && key != "useOld" && key != "disableTitle" && key != "experimental") {
			if (confirm("Are you sure you want to overwrite existing file?")) {
				if (localStorage.useOld.toString() == "true") {
					localStorage[key] = document.querySelector("#code1").value;
				}
				else {
					localStorage[key] = codeMirror.getValue();
				}
				statusline("Saved", "green");
				localStorage.current = key;
				return true;
			}
			else {
				statusline("Canceled save", "red");
				return false;
			}
		}
		else {
			alert("Fatal error: cannot rename system file");
			save();
			self.close();
			return false;
		}
	}
	else if (!localStorage[key]) {
		if (localStorage.useOld.toString() == "true" && key != "current") {
			localStorage[key] = document.querySelector("#code1").value;
		}
		else if (key != "current") {
			localStorage[key] = codeMirror.getValue();
		}
		statusline("Saved", "green");
		localStorage.current = key;
		return true;
	}
}

function handleSaveAs() {
	var toSaveAs = prompt('Enter file name:', '');
	if (!toSaveAs) {
		statusline("Canceled or no file name", "red");
		return false;
	}
	else if (toSaveAs !== null || toSaveAs) {
		saveAs(toSaveAs);
		return true;
	}
}

function open(key) {
	if (localStorage[key]) {
		document.querySelector("#code1").value = localStorage[key];
		codeMirror.setValue(localStorage[key]);
		return true;
	}
	else {
		return false;
	}
}

function handleOpen() {
	var message = "";
	for (var i = 0; i < localStorage.length; i++) {
		if (localStorage.key(i) != "current" && localStorage.key(i) != "editorHeight" && localStorage.key(i) != "editorWidth" && localStorage.key(i) != "outputHeight" && localStorage.key(i) != "outputWidth" && localStorage.key(i) != "useOld" && localStorage.key(i) != "disableTitle" && localStorage.key(i) != "experimental") {
			message += localStorage.key(i) + "\n";
		}
	}
	if (message == "") {
		statusline("No files found!", "red");
		return false;
	}
	else {
		var toOpen = prompt("Please type in name of file you want to open: \n" + message, "");
	}
	if (localStorage[toOpen] && toOpen != "current" && toOpen != "editorHeight" && toOpen != "editorWidth" && toOpen != "outputHeight" && toOpen != "outputWidth" && toOpen != "useOld" && toOpen != "disableTitle" && toOpen != "experimental") {
		open(toOpen);
		localStorage.current = toOpen;
		statusline("File loaded", "green");
		return true;
	}
	else {
		statusline("File not found", "red");
		return false;
	}
}

function deleteFile() {
	if (localStorage.current != "null") {
		if (confirm("Are you sure you want to delete: " + localStorage.current)) {
			localStorage.removeItem(localStorage.current);
			statusline("Deleted", "green");
			localStorage.removeItem("current");
			return true;
		}
		else {
			statusline("Canceled delete", "red");
			return false;
		}
	}
	else {
		statusline("Nothing to delete!", "red");
	}
}

function lock() {
	if (document.getElementById("code1").disabled == 0) y = prompt("Enter a password to protect your work", ""), y !== null ? (document.getElementById("code1").disabled = !0, view.document.open(), view.document.write(""), view.document.close(), document.getElementById("titletext").innerText = "Page Title:", xy = document.getElementById("code1").value, document.getElementById("code1").value = "", document.getElementById("reset").disabled = !0, document.getElementById("save").disabled = !0, document.getElementById("submit").disabled = !0, document.getElementById("unlock").innerHTML = "Unlock code panel", statusline("code panel locked", "green"), codeMirrorValue = codeMirror.getValue(), codeMirror.setValue(""), codeMirror.setOption("readOnly", !0)) : statusline("error: canceled locking", "red");
	else {
		var a = prompt("Enter password to unlock", "");
		a == y ? (document.getElementById("code1").disabled = !1, document.getElementById("code1").value = xy, document.getElementById("reset").disabled = !1, document.getElementById("save").disabled = !1, document.getElementById("submit").disabled = !1, codeMirror.setValue(codeMirrorValue), codeMirror.setOption("readOnly", !1), startit(), document.getElementById("unlock").innerHTML = "Lock code panel", statusline("code panel unlocked", "green")) : statusline("error: incorrect password", "red")
	}
}
