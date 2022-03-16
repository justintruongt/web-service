<html>
<head>
<title>Halo Video Game Series</title>
<style>
body {font-family:georgia;}

    .halo{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  .pic img {
    max-width: 70px; 
    max-height: 70px; 
  }  
  }

</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">

function haloTemplate(halo){
  return `<div class="halo">
       
     
    <b>Title: </b> ${halo.Title}<br /> 
    <b>Year: </b> ${halo.Year}<br /> 
    <b>Writer: </b> ${halo.Writer}<br /> 
    <b>Producer: </b> ${halo.Producer}<br /> 
    <b>Ratings: </b> ${halo.Ratings}<br /> 
    <div class="pic"><img src="images/${halo.Image}"/></div>  `;
}







  
$(document).ready(function() {  

	$('.category').click(function(e){
        e.preventDefault(); //stop default action of the link
		cat = $(this).attr("href");  //get category from URL
		
  var request = $.ajax({
   url: "api.php?cat=" + cat,
   method: "GET",
   dataType: "json"
});
request.done(function( data ) {
  console.log(data); 
  
  //place the title of the webservice on page
  $("#halostitle").html(data.title);

  //clear previous films
  $("#halos").html("");


  //load each fil via template into div 
  $.each(data.halos,function(key,value){
      let str = haloTemplate(value);
      $("<div></div>").html(str).appendTo("#halos");

    
  });
  
  //load data on page so we can see it. 
  //$("#output").text(JSON.stringify(data));
/*
  let myData = JSON.stringify(data,null,4);


  myData = "<pre>" + myData + "</pre>";
  $("#output").html(myData);
*/

  
});
request.fail(function(xhr, status, error) {
               //Ajax request failed.
               var errorMessage = xhr.status + ': ' + xhr.statusText
               alert('Error - ' + errorMessage);
           }
);
    
	});
});	


</script>
</head>
	<body>
	<h1>Halo Video Game</h1>
		<a href="year" class="category">Halo By Year</a><br />
		<a href="ratings" class="category">Halo by Rating</a>
		<h3 id="halos">Halo</h3>
		<div id="halos">
			<p>Halos will go here</p>
		</div>







    
		<div id="output">Results go here</div>
	</body>
</html>