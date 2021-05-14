
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
var auto_refresh = setInterval(
function ()
{
$('#load_tweets').load('    test.php').fadeIn("slow");
}, 10000); // refresh every 10000 milliseconds

<body>
<div id="load_tweets"> </div>
</body>

</script>