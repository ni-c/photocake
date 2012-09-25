<?php
/**
 * photocake - A markdown photo blog based on CakePHP.
 * Copyright (C) 2012 Willi Thiel <mail@willithiel.de>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @copyright     Copyright 2012, Willi Thiel <mail@willithiel.de>
 * @link          https://github.com/ni-c/photocake
 * @license       GNU General Public License, version 2 (http://www.gnu.org/licenses/gpl-2.0.html)
 */

if (file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'database.php')) {
    header('Location: ' . str_replace('install.php', '', curPageURL()));
    die();
}

function curPageURL() {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_NAME"] == "") {
        $_SERVER["SERVER_NAME"] = "localhost" . $_SERVER["SERVER_NAME"];
    }
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

if (isset($_POST['dbconnect'])) {
    if ((@mysql_connect($_POST['host'], $_POST['login'], $_POST['password'])) && (@mysql_select_db($_POST['database']))) {
        // Create database.php
        $databaseconf = file_get_contents(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'database.php.default');
        $databaseconf = str_replace('${host}', $_POST['host'], $databaseconf);
        $databaseconf = str_replace('${user}', $_POST['login'], $databaseconf);
        $databaseconf = str_replace('${password}', $_POST['password'], $databaseconf);
        $databaseconf = str_replace('${database}', $_POST['database'], $databaseconf);
        $fh = fopen(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'database.php', 'w');
        fwrite($fh, $databaseconf);
        fclose($fh);
        // Import dump
        $lines = file(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Schema' . DIRECTORY_SEPARATOR . 'photocake.sql');
        $templine = '';
        foreach ($lines as $line) {
            // Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '')
                continue;

            // Add this line to the current segment
            $templine .= $line;
            // If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';') {
                // Perform the query
                mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
                // Reset temp variable to empty
                $templine = '';
            }
        }
		
		$core_php = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'core.php';
		$core_php_default = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'core.php.default';
		if (!file_exists($core_php)) {
			copy($core_php_default, $core_php);
		}
        header('Location: ' . str_replace('install.php', 'admin', curPageURL()));
        die();
    } else {
        $error = "Could not connect to database!<br />ERROR: " . mysql_error();
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Photocake installation</title>
		<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300&amp;subset=latin,latin-ext" type="text/css" rel="stylesheet">
		<link href="css/photocake.css" type="text/css" rel="stylesheet">
	</head>
	<body>
		<div id="wrapper">
			<div id="container">
				<div id="header">
					<h1 id="site-title">photocake installation</h1>
					<div class="clear"></div>
				</div>
				<div id="content">
					<div class="users form login" id="login-container">
						<h4>Database Configuration</h4>
						<p>
							Please provide your database credentials
						</p>
						<?php if (isset($error)): ?>
						<p class="error">
							<?php echo $error; ?>
						</p>
						<?php endif; ?>
						<form accept-charset="utf-8" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" name="database" id="database">
							<fieldset>
								<div class="input text required">
									<label for="UserUsername">Host</label>
									<input type="text" name="host" required="1" id="host" value="<?php echo (isset($_POST['host'])) ? $_POST['host'] : 'localhost' ?>" />
								</div>
								<div class="input text required">
									<label for="UserUsername">Login</label>
									<input type="text" name="login" required="1" id="login" <?php echo (isset($_POST['login'])) ? 'value="' . $_POST['login'] .'" ' : '' ?>/>
								</div>
								<div class="input password">
									<label for="UserUsername">Password</label>
									<input type="password" name="password" id="password" />
								</div>
								<div class="input text required">
									<label for="UserUsername">Database</label>
									<input type="text" name="database" required="1" id="database" <?php echo (isset($_POST['database'])) ? 'value="' . $_POST['database'] .'" ' : '' ?>/>
								</div>
								<div class="submit">
									<input type="submit" name="dbconnect" id="dbconnect" value="Install -->" />
								</div>
							</fieldset>
						</form>
					</div>
					<div class="clear"></div>
				</div>
				<div id="footer"></div>
			</div>
		</div>
	</body>
</html>