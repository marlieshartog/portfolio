<?php
	session_start();

	# connect to the database
	include('cms/config.inc.php');
	include('cms/database.class.php');

	$db = new Database_class(DB_HOST, DB_NAME, DB_USER, DB_PASS);

	$db->opendb();

	# if specified that language is english, show english. Else: show dutch
	if (isset($_GET['language'])) {
		if ($_GET['language'] === 'EN_en') {
			$_SESSION['language'] = 'EN_en'; 
		} else if($_GET['language'] === 'NL_nl'){
			$_SESSION['language'] = 'NL_nl';
		}
	}
	else{
		$_SESSION['language'] = 'NL_nl'; 		
	}
	var_dump($_SESSION);
	# Get the texts in the right language
	$query 		= "SELECT ".$_SESSION['language'].", id FROM texts";  
	$texts_raw 	= $db->querydb($query); 
	$texts 		= array();

	# prepare the text array in a friendly way
	foreach ($texts_raw as $key => $value) {
		$texts[$value['id']] = $value[$_SESSION['language']];
	}

	var_dump($texts[20]); 
?>

<head>
	<title>Marlies Hartog | Starting PHP Developer</title>

<!--stylesheets-->
	<link rel="stylesheet" media="all" type="text/css" href="style/css/normalize.css" />
	<link rel="stylesheet" media="all" type="text/css" href="style/css/style.css" />
	<link href='http://fonts.googleapis.com/css?family=BenchNine|Marcellus|Muli' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Didact+Gothic' rel='stylesheet' type='text/css'>

<!--voor de mobiele sites-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>

<body>
	<div class="content">
	<!--header-->
		<header class="main-header">
			<div class="language">
				<ul>
					<?php 	if ($_GET['language'] === 'NL_nl') {
								echo '<li><a href="?language=EN_en">English</a></li>';
							}
							if ($_GET['language'] === 'EN_en') {
								echo '<li><a href="?language=NL_nl">Nederlands</a></li>';
							}
					?>	
				</ul>
			</div>
			<div class="logo-container">
				<a class="logo" href="http://www.marlieshartog.nl">Marlies Hartog</a>
			</div> 
		</header>
	<!--site wrapper-->
		<div class="site-wrapper">
				<div class="paragraph about-me">
					<h1>About me</h1>
					<p class="work-motivation"><?php echo $texten[12]; ?></p>
					<p class="personal-motivation">Besides coding, there are a lot of other things I love (to do). I like to keep myself fit by eating responsibly (on which I'm writing a <a href="">blog</a> and going to the gym about twice a week. The Body Pump and RPM training lessons are my favorite. Besides physical exercise, there's lots of other stuff I enjoy. Going to music festivals or parties, traveling all around the world, ironing my laundry, shopping for lots and lots of new clothes and reading interesting books are things that make me happy. I prefer to end week days by watching shows like Girls, Suits, Game of Thrones, American Horror Story and Dragonball Z. </p>
					<span class="clearfix"></span>

					<form method="get" action="cv_marlieshartog.doc">
						<button type="submit">Resume(.PDF)</button>
					</form> 
				</div>
				<div class="paragraph portfolio">
					<div class="portfolio-header">
						<h1>Portfolio</h1>
						<p>During my PHP-training, every week I got an extra assignment, challenging me to use the new code I learned. I coded them all by myself, never entering a new part before I fully understood what I was doing. Every week I see progress, and hopefully soon I will look back on these projects thinking: what was I thinking? :)</p> 
					</div> 
					<div class="portfolio-content">
						<div class="newest-projects">
							<div class="project project-1">
								<h2>Tic tac toe</h2>
								<p>I particularly liked this assignment, because it was the first time I build a game from scratch - all by myself! I liked thinking out the steps I had to take. Figuring out where and when what tags and code to use was more of a challenge, but with some help from google and hints from skilled befriended programmers, I got a working game. Next up is to play against a computer and enlarge the playing field. </p> 
								<form action="http://www.marlieshartog.nl/?tictactoe">
									<button type="submit">See result</button>
								</form>
								<form method="get" action="tictactoe.zip">
									<button type="submit">See source</button>
								</form>
							</div>
							<div class="project project-2">
								<h2>Login system</h2>
								<p>I worked 2 full days on this assignment. I remember thinking: oh my, I'm making something I use everyday! After finishing, the most important thing I learned was how to put gut use to $_SESSION. I can't wait to learn more on security, that got me interested. </p> 
								<form action="http://www.marlieshartog.nl/?login_system">
									<button type="submit">See result</button>
								</form>
								<form method="get" action="login_system.zip">
									<button type="submit">See source</button>
								</form>
							</div>
							<div class="project project-3">
								<h2>Lorem Ipsum</h2>
								<p>I worked 2 full days on this assignment. I remember thinking: oh my, I'm making something I use everyday! After finishing, the most important thing I learned was how to put gut use to $_SESSION. I can't wait to learn more on security, that got me interested. </p> 
								<form action="">
									<button type="submit">See result</button>
								</form>
								<form method="get" action=".zip">
									<button type="submit">See source</button>
								</form>
							</div>
							<span class="clearfix"></span>
						</div>
					</div>
				</div>	
				<footer>
					<div class="paragraph contact">
						<h1>Contact</h1>
						<div class="block-contact contact-online">
							<h3>Online</h3>
							<ul>
								<li><a href="http://www.facebook.com/marlies.hartog.3">Facebook</a></li>
								<li><a href="github??">Github</a></li>
								<li><a href="linkedin??">LinkedIn</a></li>
								<li><a href="http://www.marlieshartog.nl/?send_email"></a></li>
							</ul>
						</div>
						<div class="block-contact contact-offline">
							<h3>Offline</h3>
							<address>
								Marlies Hartog<br/>
								Nieuwstraat 24A<br/>
								1441 CM Purmerend<br/>
								06 129 86 152
							</address>
						</div>
						<span class="clearfix"></span>	
					</div>
				</footer>
		</div>
	</div>
</body>
