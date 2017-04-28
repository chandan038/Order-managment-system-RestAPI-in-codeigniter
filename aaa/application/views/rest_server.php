<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>REST Server Tests</title>

    <style>

    ::selection { background-color: #E13300; color: white; }
    ::-moz-selection { background-color: #E13300; color: white; }

    body {
        background-color: #FFF;
        margin: 40px;
        font: 16px/20px normal Helvetica, Arial, sans-serif;
        color: #4F5155;
        word-wrap: break-word;
    }

    a {
        color: #039;
        background-color: transparent;
        font-weight: normal;
    }

    h1 {
        color: #444;
        background-color: transparent;
        border-bottom: 1px solid #D0D0D0;
        font-size: 24px;
        font-weight: normal;
        margin: 0 0 14px 0;
        padding: 14px 15px 10px 15px;
    }

    code {
        font-family: Consolas, Monaco, Courier New, Courier, monospace;
        font-size: 16px;
        background-color: #f9f9f9;
        border: 1px solid #D0D0D0;
        color: #002166;
        display: block;
        margin: 14px 0 14px 0;
        padding: 12px 10px 12px 10px;
    }

    #body {
        margin: 0 15px 0 15px;
    }

    p.footer {
        text-align: right;
        font-size: 16px;
        border-top: 1px solid #D0D0D0;
        line-height: 32px;
        padding: 0 10px 0 10px;
        margin: 20px 0 0 0;
    }

    #container {
        margin: 10px;
        border: 1px solid #D0D0D0;
        box-shadow: 0 0 8px #D0D0D0;
    }
    </style>
</head>
<body>

<div id="container">
    <h1>REST Server Tests</h1>

    <div id="body">

        <h2><a href="<?php echo site_url(); ?>">Home</a></h2>
		<p>
            Click on the links to check whether the REST server is working.
        </p>

        <ol>
            <li><a href="<?php echo site_url('api/orders'); ?>">Users</a></li>
            <li><a href="<?php echo site_url('api/orders/1'); ?>">User #1</a></li>
            <li><a href="<?php echo site_url('api/orders/users?format=html'); ?>">Users</a> - get it in HTML (users?format=html)</li>
        </ol>

    </div>

</div>

<script src="https://code.jquery.com/jquery-1.12.0.js"></script>

<script>
    var App = App || {};
	App.rest = (function restModule(window) {
    var _alert = window.alert;
    var _JSON = window.JSON;
    var _$ajax = null;
    var $ = null;
    function _ajaxDone(data) {
		_alert(_JSON.stringify(data, null, 2));
    }
    function _ajaxFail() {
            _alert('Oh no! A problem with the Ajax request!');
        }
	function _ajaxEvent($element) {
            $.ajax({
                    url: $element.attr('href')
                })
                .done(_ajaxDone)
                .fail(_ajaxFail);
        }
	function _bindEvents() {
            _$ajax.on('click.app.rest.module', function (event) {
                event.preventDefault();
				_ajaxEvent($(this));
            });
        }
    function _cacheDom() {
            _$ajax = $('#ajax');
        }

        return {
            init: function init(jQuery) {
                $ = jQuery;
                _cacheDom();
                _bindEvents();
            }
        };
    }(window));
    $(function domReady($) {
        App.rest.init($);
    });
</script>
</body>
</html>
