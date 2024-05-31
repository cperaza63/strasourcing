<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<body>
   <select id="customerNameList" name="customer">
      <option value="John">John</option>
      <option value="David">David</option>
   </select>
</body>
<script>
$(document).ready(function () {
   var data = [
      { "name": "Bob", "customerName": "Bob" },
      { "name": "Mike", "customerName": "Mike" }
   ];
   for (var index = 0; index <= data.length; index++) {
      $('#customerNameList').append('<option value="' + data[index].name + '">' + data[index].customerName + '</option>');
   }
});
</script>
</html>