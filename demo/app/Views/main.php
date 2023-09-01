<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
</head>
<body>
    <h1>Congratulations! You successfully login the website</h1>
	<h1>Welcome to the Main Page</h1>
	<p>This is the main page of our website.</p>
    <?php
        echo 'You are logged in as '.$_SESSION['user'];        
    ?>
    <h3><?= $message?> in <?=$year?> </h3>

    
    <p>This area is to display publication.</p>
    <?php
        foreach ($pubs as $row) {            
            printf("[%d].%s. %s, \"%s\", %d.",$row['PID'],$row['PType'],$row['Authors'],$row['PName'],$row['PYear']);
            echo '<br>';
        }      
    ?>
    <form action="auth/logout" method="get">                    
        <button type="submit" class="btn btn-primary">Log out</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <button onclick="sendRequest()">Send AJAX Request</button>
	
    <div id="ajaxResponse"></div>

	<script>
		function sendRequest() {
			var xhttp = new XMLHttpRequest();
			
			xhttp.open("POST", "<?php echo site_url('auth/ajax'); ?>", true);            
            // setting "X-Requested-With" as "XMLHTTPRequest" in header is important
            // otherwise the request->isAJAX() does not work.
			xhttp.setRequestHeader("X-Requested-With", "XMLHTTPRequest");
			xhttp.send();
            
            xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {                    
                    alert('Response received!');
                    document.getElementById("ajaxResponse").innerHTML = this.responseText;                                                             
				}
			};
		}        
	</script>
</body>
</html>