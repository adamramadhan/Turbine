<?php


	/**
	 * A bunch of general browser bugfixes
	 * 
	 * Usage: Nobrainer, just switch it on
	 * Example: -
	 * Status: Beta
	 * 
	 * @param mixed &$parsed
	 * @return void
	 */
	function bugfixes(&$parsed){
		global $browser;
		foreach($parsed as $block => $css){

			// IE 6 global bugfixes
			if($browser->family == 'MSIE' && floatval($browser->familyversion) < 7){
				// Image margin bottom bug
				if(!isset($parsed[$block]['img'])){
					$parsed[$block]['img'] = array();
				}
				$parsed[$block]['img']['vertical-align'] = 'bottom';
				CSSP::comment($parsed[$block]['img'], 'vertical-align', 'Added by bugfix plugin');
				// Background image flickers on hover
				if(!isset($parsed[$block]['html'])){
					$parsed[$block]['html'] = array();
				}
				if(!isset($parsed[$block]['html']['filter'])){
					$parsed[$block]['html']['filter'] = 'expression(document.execCommand("BackgroundImageCache",false,true))';
					CSSP::comment($parsed[$block]['html'], 'filter', 'Added by bugfix plugin');
				}
				else{
					if(!strpos($parsed[$block]['html']['filter'], 'expression(document.execCommand("BackgroundImageCache",false,true))')){
						$parsed[$block]['html']['filter'] .= ' expression(document.execCommand("BackgroundImageCache",false,true))';
						CSSP::comment($parsed[$block]['html'], 'filter', 'Modified by bugfix plugin');
					}
				}
			}

			// IE 6 + 7 global bugfixes
			if($browser->family == 'MSIE' && floatval($browser->familyversion) < 8){
				// Enable full styleability for IE-buttons
				// See http://www.sitepoint.com/forums/showthread.php?t=547059
				if(!isset($parsed[$block]['button'])){
					$parsed[$block]['button'] = array();
				}
				$parsed[$block]['button']['overflow'] = 'visible';
				$parsed[$block]['button']['width'] = 'auto';
				$parsed[$block]['button']['white-space'] = 'nowrap';
				CSSP::comment($parsed[$block]['button'], 'overflow', 'Added by bugfix plugin');
				CSSP::comment($parsed[$block]['button'], 'width', 'Added by bugfix plugin');
				CSSP::comment($parsed[$block]['button'], 'white-space', 'Added by bugfix plugin');
			}

			// Firefox global bugfixes
			if($browser->engine == 'Gecko'){
				// Ghost margin around buttons
				// See http://www.sitepoint.com/forums/showthread.php?t=547059
				if(!isset($parsed[$block]['button::-moz-focus-inner'])){
					$parsed[$block]['button::-moz-focus-inner'] = array();
				}
				$parsed[$block]['button::-moz-focus-inner']['padding'] = '0';
				$parsed[$block]['button::-moz-focus-inner']['border'] = 'none';
				CSSP::comment($parsed[$block]['button::-moz-focus-inner'], 'padding', 'Added by bugfix plugin');
				CSSP::comment($parsed[$block]['button::-moz-focus-inner'], 'border', 'Added by bugfix plugin');
			}

			foreach($parsed[$block] as $selector => $styles){

				// IE 6 local bugfixes
				if($browser->family == 'MSIE' && floatval($browser->familyversion) < 7){
					// Float double margin bug, fixed with a behavior as this only affects the floating object and no descendant of it
					if(isset($parsed[$block][$selector]['float']) && $parsed[$block][$selector]['float'] != 'none'){
						$htc_path = rtrim(dirname($_SERVER['SCRIPT_NAME']),'/').'/plugins/bugfixes/doublemargin.htc';
						if(!isset($parsed[$block][$selector]['behavior'])){
							$parsed[$block][$selector]['behavior'] = 'url("'.$htc_path.'")';
						}
						else{
							if(!strpos($parsed[$block][$selector]['behavior'],'url("'.$htc_path.'")')){
								$parsed[$block][$selector]['behavior'] .= ', url("'.$htc_path.'")';
							}
						}
					}
				}
			
				// IE 6 + 7 local bugfixes
				// if($browser->family == 'MSIE' && floatval($browser->familyversion) < 8){}
			}

		}
	}


	/**
	 * Register the plugin
	 */
	$cssp->register_plugin('before_compile', 0, 'bugfixes');


?>