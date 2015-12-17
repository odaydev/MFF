<html>
<head>
<link rel="stylesheet" href="jPages/css/jPages.css">
</head>
<body>
<div class="holder"></div>

<!-- Item container (doesn't need to be an UL) -->
<ul id="itemContainer">
<!-- Items -->
<li>1</li>
<li>2</li>
<li>3</li>
<li>4</li>
<li>5</li>

</ul>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> 	
<script src="jPages/js/jPages.min.js"></script>

</body>
</html>
<script>
$(function(){

  $("div.holder").jPages({
      containerID : "itemContainer",
      perPage      : 2,
	  startPage    : 1,
	  startRange   : 1,
	  midRange     : 5,
	  endRange     : 1
  });

});

$('#dd').click(function(){

    console.log('rr');
    $('#dd i').toggleClass("fa fa-heart");
   });
</script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<!-- foreach($_POST as $key => $value){
	$$key  =trim(strip_tags($value));
} -->
<div id="dd">
<i class="fa fa-heart-o" id="indice"></i>
</div>