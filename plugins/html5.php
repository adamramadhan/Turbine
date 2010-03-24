<?php


	/**
	 * Default styles for HTML5 elements
	 * 
	 * Usage: Nobrainer, just switch it on
	 * Example: -
	 * Status: Beta
	 * 
	 * html5
	 * Adds the correct default styles for HTML5 elements
	 * Source: http://www.whatwg.org/specs/web-apps/current-work/multipage/rendering.html#the-css-user-agent-style-sheet-and-presentational-hints
	 * @param string $output
	 * @return void
	 */
	function html5(&$output){
		$styles = "command,datalist,source{display:none}article,aside,figure,figcaption,footer,header,hgoup,menu,nav,section,summary{display:block}figure,menu{margin-top:1em;margin-bottom:1em}dir menu,dl menu,menu dir,menu dl,menu menu,menu ol,menu ul{margin-top:0;margin-bottom:0}";
		$output = $styles.$output;
	}


	/**
	 * Register the plugin
	 */
	$cssp->register_plugin('before_output', 0, 'html5');


?>