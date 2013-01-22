var editboxHTML = 
'<html class="expand close">' +
'<head>' +
'<script src="http://htmlbin.com/js/codemirror.js" type="text/javascript"></scr' + 'ipt>' +
'<style type="text/css">' +
'.expand { width: 100%; height: 100%; }' +
'.close { border: none; margin: 0px; padding: 0px; }' +
'html,body { overflow: hidden; }' +
'#code {background-color: #eaefff;}' +
'.CodeMirror-line-numbers {' + 
'        width: 2.2em;' +
'        color: #aaa;' +
'        background-color: #eee;' +
'        text-align: right;' +
'        padding-right: .3em;' +
'        font-size: 10pt;' +
'        font-family: monospace;' +
'        padding-top: .4em;' +
'}' +
'<\/style>' +
'<\/head>' +
'<body class="expand close" onload="document.f.ta.focus(); document.f.ta.select();">' +
'<form class="expand close" method="post" name="f">' +
'<textarea id="code" class="expand close" style="background: #def; font-family: monospace;" name="ta" wrap="hard" spellcheck="false">' +
'' +
'<\/textarea>' +
'<div id="save" style="position: absolute; bottom: 3px; right: 20px; font-size: 15px;">' +
'<input type="submit" value="Save"\/>' +
' Custom URL: <input type="text" name="custom"\/>' +
'<\/div>' +
'<\/form>' +
 
 
'<script type="text/javascript">' +
'  var editor = CodeMirror.fromTextArea("code", {' +
'    height: "100%",' +
'    lineNumbers: true,' +
'    tabMode: "spaces",' +
'    indentUnit: 4,' + 
'    autoMatchParens: true,' +
'    parserfile: ["parsexml.js", "parsecss.js", "tokenizejavascript.js", "parsejavascript.js", "parsehtmlmixed.js"],' +
'    stylesheet: ["http://htmlbin.com/css/xmlcolors.css", "http://htmlbin.com/css/jscolors.css", "http://htmlbin.com/css/csscolors.css"],' +
'    path: "http://htmlbin.com/js/"' +
'  });' +
'</scr' + 'ipt>' +
 
 
'<\/body>' +
'<\/html>';
 
var defaultStuff = '';
 
var extraStuff = '';
 
var old = '';
 
var loaded = false;
        
 
function init()
{
  window.editbox.document.write(editboxHTML);
  window.editbox.document.close();
  //window.editbox.document.f.ta.value = defaultStuff;
  setInterval("update()", 150);
  setInterval("saveLocally()", 1000);
}
 
function update()
{
  if (window.editbox.editor == undefined) return;
  code = window.editbox.editor.getCode();
  var d = dynamicframe.document; 
 
  if (old != code) {
    old = code;
    d.open();
    d.write(old);
    if (old.replace(/[\r\n]/g,'') == defaultStuff.replace(/[\r\n]/g,''))
      d.write(extraStuff);
    d.close();
  }
}
 
function saveLocally() {
    if (!loaded) {
        code = localStorage.getItem('code');
        if (code == null) code = "";
        window.editbox.editor.setCode(code);
        loaded = true;
    } else {
        code = window.editbox.editor.getCode();
        localStorage.setItem('code', code);
    }
}