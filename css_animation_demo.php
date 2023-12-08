<!DOCTYPE html>
<html>
<head>
	<title>css animation demo</title>

	<style type="text/css">	
		.box-model{	
			border: 2px solid  red;		
			width: 200px;
			height: 200px;
			position: relative;
			animation:example 5s infinite;
		}
		@keyframes example{
			from{left: 0px;}
			to{left: 100px;}
		}
		img{
			height: 100%;
			width: auto;			
		}		

	</style>
</head>
<body>
	<h1>CSS ANIMATION</h1>
	
	<div class ="box-model"><img src="testing.png" alt=""></div>
	
	
	<p>When an animation is over, it goes back tooriginal style.</p>
</body>
</html>