<?php

# Returns the CSS standards, if not informed any files, the 
# search function first CSS file from the current directory.
function default_css(){
	$default = check_file_exists(array('default_1.css', 'default_2.css'));
	if(empty($default)){
		$default = array_values(array_filter(scandir('.'), 'filter_css'));
		return array($default[0]);
	}
	return $default;
}

# Returns TRUE or FALSE if the specified file is a CSS
function filter_css($file){
	$file = explode('.', $file);
	return $file[count($file) - 1] == 'css';
}

# Checks whether the files passed by the array exists in the
# current directory, if there is, delete the array.
function check_file_exists($file){
	foreach($file as $key => $value)
		if(!file_exists($value))
			unset($file[$key]);
	return array_unique($file);
}

# Returns an array of CSS files that are in the input mechanisms
function get_css($entry){
	$include = check_file_exists(explode('+', $entry));
	return (!empty($include)) ? $include : default_css();
}

# If there is a cookie and no parameter $_GET, we set a cookie with your own content
if(isset($_COOKIE['css_stylesheet']) && !isset($_GET['style'])){
		$include = get_css($_COOKIE['css_stylesheet']);
} else {
# If there is a parameter, we set the cookie with the style of the parameter,
# if no cookie and no parameter, we set the cookie with a default style
		$include = (isset($_GET['style'])) ? get_css($_GET['style']) : default_css();
}
setcookie('css_stylesheet', implode('+', $include));

# If last page visited can’t be found (HTTP_REFERER) will redirect back to index of the site.
header('Content-type: text/css');
if(isset($_GET['style']))
	(isset($_SERVER['HTTP_REFERER'])) ? header("Location:".$_SERVER['HTTP_REFERER']) : header("Location:http://".$_SERVER['SERVER_NAME']);
# Includes CSS files in the header
if(!empty($include)) { foreach($include as $value) include $value; } else { die(".css NOT FOUND"); }
