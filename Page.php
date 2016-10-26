<?php	// UTF-8 marker äöüÄÖÜß€

abstract class Page
{

    protected function __construct()
    {
        session_start();
        error_reporting(E_ALL);
    }

    protected function __destruct()
    {
    }

    protected function generatePageHeader($headline = "", $style ="", $script = "")
    {
        $headline = htmlspecialchars($headline);
        $style = htmlspecialchars($style);
        $script = htmlspecialchars($script);
        header("Content-type: text/html; charset=UTF-8");
        echo<<<EOT
<!--debug: this page being viewed is generated by php-->
<!DOCTYPE html>
<!--UTF-8 marker äöüÄÖÜß€-->
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
		<title>$headline</title>
		<link rel="stylesheet" type="text/css" href="$style" />
		<script type="text/javascript" src="$script"> </script>
		<noscript> <p>Bitte aktivieren Sie JavaScript !</p> </noscript>	
	</head>
	<body>
		<div class="page-wrapper">
			<header><h1>$headline</h1></header>
			<nav>
				<ul>
					<li><a href="Task2.php">Scramble</a></li>
				</ul>
			</nav>	

EOT;

    }

    protected function generatePageFooter()
    {
        echo<<<EOT

		</div>
	</body>
</html>
EOT;
    }

    protected function processReceivedData()
    {
        if (get_magic_quotes_gpc()) {
            throw new Exception
            ("Bitte schalten Sie magic_quotes_gpc in php.ini aus!");
        }
    }
} // end of class
