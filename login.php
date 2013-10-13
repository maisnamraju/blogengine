<!DOCTYPE html>
       	<html>
       	<head>
 			<meta charset="utf-8">
 			<meta http-equiv="X-UA-Compatible" content="IE=edge">
 			<title>Login</title>
 			<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css">            	
            	<style>
            		#middle {
            			position:absolute;
            			margin:0 auto;
            			top:20%;
     					left:30%
            		}	
            	</style>
       	</head>
       	<body>
       		<div class="pure-g-r"> 
       			<div id="middle" class="pure-u-1-2">
       				<form action="app/adminpanel.php"  method="post"  class="pure-form pure-form-aligned">
					    <fieldset>
						    <legend>LOGIN</legend>	
						        <div class="pure-control-group">
						            <label for="name">Username</label>
						            <input name="name" id="name" type="text" placeholder="Username">
						        </div>

						        <div class="pure-control-group">
						            <label for="password">Password</label>
						            <input name="password" id="password" type="password" placeholder="Password">
						        </div>
						        <div class="pure-controls">					           
						            <input type="submit" class="pure-button pure-button-primary">
						        </div>
					    </fieldset>
					</form>
       			</div>	
       		</div>
       	</body>
       </html>       