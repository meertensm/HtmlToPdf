<?php

    require_once 'vendor/autoload.php';

    use \MCS\HtmlToPdf;

    try{

        $html = file_get_contents('demo.html');

        $pathToWkhtmltopdf = '/usr/local/bin/wkhtmltopdf';

        $pdf = new HtmlToPdf($html, $pathToWkhtmltopdf);

        $pdf->addBeforeCommand('unset DYLD_LIBRARY_PATH');

        //$pdf->setParam('page-size', 'A6');
        //$pdf->setParam('margin-left', '100');
        //$pdf->setParam('orientation', 'landscape');

        $pdfString = $pdf->generate();

        header('Content-Type: application/pdf');
        die($pdfString);

    }
    catch(Exception $e){
        dump($e->getMessage());
    }


































?>
<script> Sfdump = window.Sfdump || (function (doc) { var refStyle = doc.createElement('style'), rxEsc = /([.*+?^${}()|\[\]\/\\])/g, idRx = /\bsf-dump-\d+-ref[012]\w+\b/, keyHint = 0 <= navigator.platform.toUpperCase().indexOf('MAC') ? 'Cmd' : 'Ctrl', addEventListener = function (e, n, cb) { e.addEventListener(n, cb, false); }; (doc.documentElement.firstElementChild || doc.documentElement.children[0]).appendChild(refStyle); if (!doc.addEventListener) { addEventListener = function (element, eventName, callback) { element.attachEvent('on' + eventName, function (e) { e.preventDefault = function () {e.returnValue = false;}; e.target = e.srcElement; callback(e); }); }; } function toggle(a, recursive) { var s = a.nextSibling || {}, oldClass = s.className, arrow, newClass; if ('sf-dump-compact' == oldClass) { arrow = '&#9660;'; newClass = 'sf-dump-expanded'; } else if ('sf-dump-expanded' == oldClass) { arrow = '&#9654;'; newClass = 'sf-dump-compact'; } else { return false; } a.lastChild.innerHTML = arrow; s.className = newClass; if (recursive) { try { a = s.querySelectorAll('.'+oldClass); for (s = 0; s < a.length; ++s) { if (a[s].className !== newClass) { a[s].className = newClass; a[s].previousSibling.lastChild.innerHTML = arrow; } } } catch (e) { } } return true; }; return function (root) { root = doc.getElementById(root); function a(e, f) { addEventListener(root, e, function (e) { if ('A' == e.target.tagName) { f(e.target, e); } else if ('A' == e.target.parentNode.tagName) { f(e.target.parentNode, e); } }); }; function isCtrlKey(e) { return e.ctrlKey || e.metaKey; } addEventListener(root, 'mouseover', function (e) { if ('' != refStyle.innerHTML) { refStyle.innerHTML = ''; } }); a('mouseover', function (a) { if (a = idRx.exec(a.className)) { try { refStyle.innerHTML = 'pre.sf-dump .'+a[0]+'{background-color: #B729D9; color: #FFF !important; border-radius: 2px}'; } catch (e) { } } }); a('click', function (a, e) { if (/\bsf-dump-toggle\b/.test(a.className)) { e.preventDefault(); if (!toggle(a, isCtrlKey(e))) { var r = doc.getElementById(a.getAttribute('href').substr(1)), s = r.previousSibling, f = r.parentNode, t = a.parentNode; t.replaceChild(r, a); f.replaceChild(a, s); t.insertBefore(s, r); f = f.firstChild.nodeValue.match(indentRx); t = t.firstChild.nodeValue.match(indentRx); if (f && t && f[0] !== t[0]) { r.innerHTML = r.innerHTML.replace(new RegExp('^'+f[0].replace(rxEsc, '\\$1'), 'mg'), t[0]); } if ('sf-dump-compact' == r.className) { toggle(s, isCtrlKey(e)); } } if (doc.getSelection) { try { doc.getSelection().removeAllRanges(); } catch (e) { doc.getSelection().empty(); } } else { doc.selection.empty(); } } }); var indentRx = new RegExp('^('+(root.getAttribute('data-indent-pad') || ' ').replace(rxEsc, '\\$1')+')+', 'm'), elt = root.getElementsByTagName('A'), len = elt.length, i = 0, t = []; while (i < len) t.push(elt[i++]); elt = root.getElementsByTagName('SAMP'); len = elt.length; i = 0; while (i < len) t.push(elt[i++]); root = t; len = t.length; i = t = 0; while (i < len) { elt = root[i]; if ("SAMP" == elt.tagName) { elt.className = "sf-dump-expanded"; a = elt.previousSibling || {}; if ('A' != a.tagName) { a = doc.createElement('A'); a.className = 'sf-dump-ref'; elt.parentNode.insertBefore(a, elt); } else { a.innerHTML += ' '; } a.title = (a.title ? a.title+'\n[' : '[')+keyHint+'+click] Expand all children'; a.innerHTML += '<span>&#9660;</span>'; a.className += ' sf-dump-toggle'; if ('sf-dump' != elt.parentNode.className) { toggle(a); } } else if ("sf-dump-ref" == elt.className && (a = elt.getAttribute('href'))) { a = a.substr(1); elt.className += ' '+a; if (/[\[{]$/.test(elt.previousSibling.nodeValue)) { a = a != elt.nextSibling.id && doc.getElementById(a); try { t = a.nextSibling; elt.appendChild(a); t.parentNode.insertBefore(a, t); if (/^[@#]/.test(elt.innerHTML)) { elt.innerHTML += ' <span>&#9654;</span>'; } else { elt.innerHTML = '<span>&#9654;</span>'; elt.className = 'sf-dump-ref'; } elt.className += ' sf-dump-toggle'; } catch (e) { if ('&' == elt.innerHTML.charAt(0)) { elt.innerHTML = '&#8230;'; elt.className = 'sf-dump-ref'; } } } } ++i; } }; })(document); </script> <style> pre.sf-dump { display: block; white-space: pre; padding: 5px; } pre.sf-dump span { display: inline; } pre.sf-dump .sf-dump-compact { display: none; } pre.sf-dump abbr { text-decoration: none; border: none; cursor: help; } pre.sf-dump a { text-decoration: none; cursor: pointer; border: 0; outline: none; }pre.sf-dump{background-color:#fff; color:#222; line-height:1.2em; font-weight:normal; font:12px Monaco, Consolas, monospace; word-wrap: break-word; white-space: pre-wrap; position:relative; z-index:100000}pre.sf-dump .sf-dump-num{color:#a71d5d}pre.sf-dump .sf-dump-const{color:#795da3}pre.sf-dump .sf-dump-str{color:#df5000}pre.sf-dump .sf-dump-cchr{color:#222}pre.sf-dump .sf-dump-note{color:#a71d5d}pre.sf-dump .sf-dump-ref{color:#a0a0a0}pre.sf-dump .sf-dump-public{color:#795da3}pre.sf-dump .sf-dump-protected{color:#795da3}pre.sf-dump .sf-dump-private{color:#795da3}pre.sf-dump .sf-dump-meta{color:#b729d9}pre.sf-dump .sf-dump-key{color:#df5000}pre.sf-dump .sf-dump-index{color:#a71d5d}</style><script>Sfdump("sf-dump-969392681")</script>