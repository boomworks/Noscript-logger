#&lt;noscript&gt; logger

Provides a simple logging mechanism for user agents that have JavaScript disabled.

##Requirements

*  PHP (4+, I'm guessing - tested on 5.3)

##Usage

###HTML method:

	<noscript>
		<img src="//example.com/noscript-logger/">
	</noscript>

Easy peasy.

###CSS method:

	<html class="no-js">
	<head>
		...
		<script>document.getElementsByTagName('html')[0].className='js';</script>
		<style>.no-js body {background: url(//example.com/noscript-logger/);}</style>
	</head>

This may be the preferred method, as it doesn't add junk to your beautiful HTML (you'd stick the CSS in an external stylesheet, obviously); and would still work with any evil corporate proxies & whatnot that deny JS requests instead of disabling it in the browser.

##Options

There are a few variables at the top of index.php that you can tweak:

`$response_type`:

*   'no response' - Sends a ['204 No Content' header & no body](http://www.phpied.com/204-no-content/)

*   'gif' - Sends a non-cachable 1x1 pixel transparent gif

`$log_file`:
The path to the default log file (you'll probably want to change the domain-specific log path bits if you change this)

`$log_format`:
The format of the log file (Apache Combined log format by default, you'll need to tweak the script if you change this)

Additionally, you can log to a domain-specific log file by adding a 'domain' query string parameter, e.g. `//example.com/noscript-logger/?domain=example.org` would log to the file `noscript.example.org.log` by default

##License

Copyright &copy; 2011 [Boomworks](http://boomworks.com.au/)

Licensed under the [MIT license](http://www.opensource.org/licenses/mit-license.php).

