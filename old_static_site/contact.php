<?php 

if (isset($_GET['send'])) {
	
	$validationerror = false;
	
	if (empty($_POST['name'])) {
		$validationerror = true;
		$errormessage .= '<strong>Please enter your name.</strong><br />';
	}
	
	if (empty($_POST['email'])) {
		$validationerror = true;
		$errormessage .= '<strong>Please enter your e-mail address.</strong><br />';
	}
	
	if (empty($_POST['message'])) {
		$validationerror = true;
		$errormessage .= '<strong>Please enter your message.</strong><br />';
	}

	if (!$validationerror) {
		$to = "info@larahart.co.uk";
		$subject = 'This is an email sent from the contact form on larahart.co.uk';
		$body = '
		Name: ' . $_POST['name'] . ' Email: ' . $_POST['email'] . '
		
		Message:
		' . $_POST['message'];
		
		$headers = 'From: info@larahart.co.uk';
		
		if (mail($to, $subject, $body, $headers)) {
			$emailsent = true;
		} else {
			$emailsent = false;
		}
	}	
}
		
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" dir="ltr">
<head>

<title>Lara Hart: North London Counsellor and Relationship Therapist - Contact Details</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Description" content="Gestalt counsellor and psychosexual and relationship therapist, offering friendly, confidential and professional counselling and psychosexual; therapy in North London. I work in East Finchley N2 and Muswell Hill N10." />


<link rel="stylesheet" type="text/css" href="reset.css" id="resetcss" />
<link rel="stylesheet" type="text/css" href="styles.css" id="stylescss" />
<!--[if IE]><link rel="stylesheet" type="text/css" href="iehacks.css" id="iehacks" /><![endif]-->

<script type="text/javascript" language="JavaScript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" language="JavaScript" src="js/core.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		// Initalise Core
		core.init();
	});
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-16885417-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>

<body>

<div id="main">

	<div id="centereddiv">
    
		<div id="header">
        	<img src="images/laralogo.png" border="0" alt="Lara Hart - MBACP MBASRT - counsellor and relationship therapist" id="laralogo"/>
        </div>
        
        <div id="contentshadow">
        	<div id="nav">
            	<ul>
            	    <li><a href="index.html">Home</a></li>
                    <li><a href="aboutme.html">About Me</a></li>
                    <li><a href="counselling.html">Counselling</a></li>
                    <li><a href="gestalttherapy.html">Gestalt Approach</a></li>
                    <li><a href="contact.php" class="navselected">Contact Details</a></li>
                </ul>
            </div>
            <div id="contactbanner" class="mainbanner"></div>
            <div id="content">
            <?php
			if (isset($emailsent) && $emailsent) {
				echo 'Thank you for your message I will be in contact with you shortly.';
			} else {
				echo '
          		<div id="contactsidebar" class="leftsidebar"></div>
                
                <p>For further information or to arrange an initial session<br />
                Lara Hart PG Dip Gestalt Therapy, Dip. Counselling, PG Dip Ed.<br />
                MBACP MBASRT<br />
                <strong>Tel: 07970 519 235</strong><br />
                <a href="mailto:info@larahart.co.uk">info@larahart.co.uk</a></p>

                <p>I work in East Finchley N2 and Muswell Hill N10. These areas are easily accessible by public transport. There are good transport links from Kings Cross, Camden, Finchley, Finsbury Park, Highgate and Barnet. Free car parking is available.</p>

                <h4 id="linksheading">Links</h4>
                The British Association for Counselling and Psychotherapy - <a href="http://www.bacp.co.uk" target="_blank">http://www.bacp.co.uk</a><br />
                Relationship therapy Resources and Information - <a href="http://www.basrt.org.uk/" target="_blank">http://www.basrt.org.uk</a><br />
                Gestalt Centre - <a href="http://www.gestaltcentre.co.uk" target="_blank">http://www.gestaltcentre.co.uk</a><br />
                Human Fertilisation and Embryology Authority - <a href="http://www.hfea.gov.uk" target="_blank">http://www.hfea.gov.uk</a><br />
                
                <br />
				
				
				' . $errormessage . '
                <div class="divform">
                    <form action="?send=true" method="post" id="contactform">
                        <fieldset>
                            <legend>Contact Me</legend>
                            
                            <div>
                            	<label for="name">Your Name</label> <input type="text" id="name" name="name">
                            </div>
                            
                            <div>
                           		<label for="emailaddy">Your Email</label> <input type="text" id="email" name="email">
                            </div>
                            
                            <div>
                            	<label for="message">Your Message</label> <textarea name="message" rows=9 cols=50 wrap></textarea>
                            </div>
                            
                            <div><button type="submit" id="submit-go">Send</button></div>
                        </fieldset>
                    </form>
					<br style="clear: both;" />
                </div>
				';
			}
            ?>    
            </div>
        	<div id="roundedcorners"></div>
        </div>
        
	</div> <!-- Centered Div -->


</div> <!-- Main Div -->

</body>
</html>


