<!DOCTYPE html>
<html>
	<head>
    	<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    	<title>Chuck Bronson</title>

	    <!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
        <?php include('favicon.html'); ?>
        
        <link rel="stylesheet" href="assets/css/style.css">
    </head>
  	<body>
  		
        <?php include('navbar.html'); ?>
        
        <div class="container">
            
            <!--<img src="assets/img/play_with_style_logo.png" alt="Play with Style" class="img-responsive center-block" style="max-width: 70%;">-->
            <img src="assets/img/diff_gold.png" alt="Play with Style" class="img-responsive center-block" style="max-width: 60%;" data-video="https://www.youtube.com/embed/NFAX8jQJZjQ"  data-toggle="modal" data-target="#myModal" id="playWithStyle">
            
            <div class="row top-buffer bottom-buffer">
                <div class="col-xs-offset-3 col-xs-6 col-sm-offset-0 col-sm-4"></div>

                <div class="col-xs-offset-3 col-xs-6 col-sm-offset-0 col-sm-4"></div>

                <!--<div class="col-xs-offset-3 col-xs-6 col-sm-offset-0 col-sm-4">
                    <img src="assets/img/chucknature.png" class="img-responsive" alt="Chuck Bronson Signature">
                </div>-->
            </div>
            
            <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <!--<h4 class="modal-title">Chuck me Amadeus</h4>-->
                        </div>
                        <div class="modal-body">
                            <iframe width="100%" height="350px" src="" frameborder="0" allowfullscreen=""></iframe>
                        </div>
                    </div>
                </div>
            </div>


            <article class="col-xs-10 col-xs-offset-1">
                <h2>Chuck Bronson – there is no “s” at the end!</h2>
                <p>
                    Entsprungen aus einigen wahnsinnigen Ultimate-Vernarrten und ein paar Leuten, die weniger Ultimate Erfahrung hatten formierte sich Chuck Bronson. Entfacht durch die spektakuläre Spielweise verbreitete sich schnell der Mythos vom Bronsonstyle. Nur wenige begriffen, geschweige beherrschten, damals die Techniken und Routinen um "Party, Party" und "Scoober, Hammer" in Einklang zu bringen. Kreativität und Erfindungsreichtum fließen auch heute noch in Strömen durch unsere Venen. Besonders stolz sind wir auf jede unserer zahlreichen ausgefallenen Trophäen, welche wir auf unseren einmaligen Turnieren Jahr für Jahr überreichen, an denen auch das leibliche Wohlbefinden noch nie zu kurz gekommen ist.
                    Keep the Spirit and the Bronsonstyle up und allzeit gute Fahrt!
                </p>
                <img src="assets/img/chucknature.png" class="img-responsive col-xs-6 col-xs-offset-6 col-sm-6 col-sm-offset-6 col-md-4 col-md-offset-8" alt="Chuck Bronson Signature">
            </article>
            
        </div>
  		
        <?php include('footer.html'); ?>
        
        <script>
            $('#playWithStyle').click(function() {
                 var theModal = $(this).data("target"),
                     videoSRC = $(this).attr("data-video"),
                     videoSRCauto = videoSRC + "?modestbranding=1&rel=0&controls=1&showinfo=1&html5=1&autoplay=1";
                    $(theModal + ' iframe').attr('src', videoSRCauto);
                    $(theModal + ' button.close').click(function() {
                       $(theModal + ' iframe').attr('src', videoSRC);
                    });
            });
            
            jQuery('#myModal').on('hidden.bs.modal', function(e) {
                jQuery('#myModal iframe').attr('src', '');
            });
            
        </script>
        
  	</body>
</html>