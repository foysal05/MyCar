<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
</head>
<body>
<input type="text" class="input value1">
<input type="text" class="input value2">
<input type="text" disabled="disabled" id="result">

<script>
$(document).ready(function(){
    $(".input").keyup(function(){
          var val1 = +$(".value1").val();
          var val2 = +$(".value2").val();
          $("#result").val(val1*val2/100);
   });
});
</script>
</body>
</html>