


<form action="batchInsertEvents.php" id="add" method="post">
	 <input type="text" id="everything" name="everything" required ></input> <br>
</form>





















<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>

<script src="http://yui.yahooapis.com/3.0.0/build/yui/yui-min.js"></script>
<ul id='stuff' ></ul>
<script>




var Y = new YUI();
var lo;
var time;
var a;
var ev;
var errr = "";

var items;

function handleResponse ( json ) {
console.log(json);
    items = json.query.results.item;
	ev = items;
    console.log(items);




for(var x=0;x<items.length;x++){

	a = items[x];

	var m = /Event Name.*?<br[/]>/.exec(a.description)[0];
	var title = m.substring(22,m.length-6);

	errr += title;
	errr  += "%^&";
	errr += "220 college street";
	errr += "%^&";
	errr += a.category.substring(0,10).replace(/\//g, "-");
	errr += "%^&";
	errr += "12:59";
	errr += "%^&";
	errr += "220 college street";
	errr += "%^&";
	errr += "202";
	errr += "%^&";
	errr += "Dance";
	errr += "%^&"
	errr += "Casual Tuesdays";
	errr += "%^&"
	errr += "descript";

	errr += "****"
}

document.getElementById("everything").value = errr;


document.getElementById("add").submit();

    //for ( var i = 0; i < items.length; i++ ) {
      //  Y.one( 'ul' ).append( '<li>'+items[i].description+'</li>' );
    //}
};
 
// ref: http://developer.yahoo.com/yui/3/node/
Y.use('node', function ( Y ) {
    
    //when the DOM node utility is ready, fetch the data
Y.Get.script("http://query.yahooapis.com/v1/public/yql?q=SELECT%20*%20FROM%20rss%20WHERE%20url%3D%22http%3A%2F%2F25livepub.collegenet.com%2Fcalendars%2Ffeatured-title-events-calendar-search.rss%22&diagnostics=true&format=json&callback=handleResponse" );
//Y.Get.script( "http://query.yahooapis.com/v1/public/yql?q=SELECT%20*%20FROM%20xml%20WHERE%20url%3D%22http%3A%2F%2F25livepub.collegenet.com%2Fcalendars%2Fall-campus-events.rss%22%20%7C%20tail(count%3D100)&diagnostics=true&format=json&callback=handleResponse" );
 //Y.Get.script( "http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20rss%20where%20url%3D%22http%3A%2F%2F25livepub.collegenet.com%2Fcalendars%2Fall-campus-events.rss%22&format=json&diagnostics=true&callback=handleResponse	" );
} );
 
// run the query in the YQL console: http://developer.yahoo.com/yql/console/?q=select%20*%20from%20rss%20where%20url%3D%27http%3A%2F%2Fwww.un.org%2Fapps%2Fnews%2Frss%2Frss_top.asp%27
</script>

</script>
<html>
<body>
<form action="insertOtherEvents.php" method="post">
			<input id="insert" type="text" name="events" hidden/>

					</form>

hi
</body>
</html>
