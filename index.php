<html>

<head>

<title> Geo-Locator</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>


<style>
html,body{

	height:100%;
}
.container{

background-image: url("abc.jpeg");

width:100%;
height: 100%;
background-size: cover;
background-position: center;
padding-top:200px;
}

.center{
font-family: 'Roboto Condensed';
	text-align: center;
}
.shade{
	color:white;
}

.alert{
	display:none;
}

.svg-wrapper {
  position: relative;
  top: 40%;
  
  	  margin: 0 auto;
  width: 320px;  
  height:60px;

}
.shape {
  stroke-dasharray: 42 240;
  stroke-dashoffset: 156;
  stroke-width: 0px;
  fill: transparent;
  stroke: white;
  
  transition: stroke-width 1s, stroke-dashoffset 1s, stroke-dasharray 0.3s;
}
.text {
  font-family: 'Roboto Condensed';
  font-size: 22px;
  line-height: 32px;
  letter-spacing: 3px;
  color: white;
  top: -48px;
  position: relative;
}
.svg-wrapper:hover .shape {
  stroke-width: 2px;
  stroke-dashoffset: 0;
  stroke-dasharray: 760;

}

.borders{
background:#7f7f7f;
  background:rgba(0,0,0,0.5);
  border-radius:5px;
}
</style>

</head>



<body>


<div class="container">

			<div class="row">

					<div class=" col-md-6 col-md-offset-3 center borders">
					
					<h1 class="center shade"> Geo-Locator <span class="glyphicon glyphicon-hand-down"></span></h1>

					<p class="lead center shade" >Enter the Address to get the Postal code!</p>

					<form>
					<div class="form-group">

					<input id="address" type="text" placeholder="Eg. 221B Baker Street  " class="form-control" name="city"/>
					</div>

					
<div class="svg-wrapper" id="findpostcode">
  <svg height="60" width="320" xmlns="http://www.w3.org/2000/svg">
    <rect class="shape" height="60" width="315" />
    <div class="text">Post-Code please?</div>

  </svg>
</div> 
					</form>

						<div id="success" class="alert alert-success center">
  		Success!
  			</div>

						<div id="fail" class="alert alert-danger center">
	  		The postcode could not be found!
  			</div>
      
  			
</div>
	</div>			

		
</div>

<script>


$("#findpostcode").click(function(){
  var result=0;

  $(".alert").hide();
  
  event.preventDefault();

    $.ajax({
      type: "GET",
      url:"https://maps.googleapis.com/maps/api/geocode/xml?address="+encodeURIComponent($('#address').val())+"&key=AIzaSyAEyJEz0P8tncjrPDPa6mFYyB2FW7J14Qc",
      dataType: "xml",
      success: processXML,
      error :error

    });
    
    function error(){

$("#fail").html("Cannot connect to google API").fadeIn(); 
    	

    }
    function processXML(xml) {
    
      $(xml).find("address_component").each(function(){

        if($(this).find("type").text()=="postal_code")
	{
       result=1;
     
        $("#success").html("Post Code for this address is :- "+$(this).find("long_name").text()).fadeIn();
    }

 
    	  
      });
          if(result==0)
	
$("#fail").fadeIn();
        }
        }
   );


</script>

</body>

</html>