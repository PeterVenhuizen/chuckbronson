<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Betthupferl</title>

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
        <style>

            #betthupferl { 
                background-image: url('assets/img/style_petzi.png'); 
                background-repeat: no-repeat;
                background-size: 100% auto;
            }
            #betthupferl .row { margin-top: 3em; }
            #betthupferl p { text-align: justify; }
            .betthupferl-icon { 
                font-size: 3em; 
                font-weight: bold;
                display: block;
                text-align: center;
            }

            .col-sm-4 > h2 { text-align: center; }

        </style>

    </head>
    <body>

        <?php include('navbar.html'); ?>

        <div class="container">

            <div class="jumbotron" id="betthupferl">

                <div class="row">

                    <div class="col-xs-12 col-xs-offset-0 col-sm-offset-0 col-sm-4">
                        <span class="betthupferl-icon">
                            <span class="glyphicon glyphicon-time"></span>
                        </span>
                        <p>40 min NON continuous play. Wenn die Zeit abgelaufen ist wird der Punkt fertig gespielt.</p>
                    </div>

                    <div class="col-xs-12 col-xs-offset-0 col-sm-offset-0 col-sm-4">
                        <span class="betthupferl-icon">
                            <span class="glyphicon glyphicon-pause"></span>
                        </span>
                        <p>Ein Timeout pro Team, nicht in den letzten 5 min.</p>
                    </div>

                    <div class="col-xs-12 col-xs-offset-0 col-sm-offset-0 col-sm-4">
                        <span class="betthupferl-icon">&#9792;</span>
                        <p>1 Dame auf der Line, auf Wunsch und Einverständnis beider Teams kann für das Spiel auf 1 oder 2 Damen - Offense entscheidet - gewechselt werden.</p>
                    </div>

                </div>

            </div>

            <h2><span class="glyphicon glyphicon-th-list"></span> Tabelle</h2>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Team</th>
                            <th>Games</th>
                            <th>W</th>
                            <th>T</th>
                            <th>L</th>
                            <th>Ø-Spirit</th>
                            <th>Score-Δ</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <?php
                        $json = file_get_contents("https://sheets.googleapis.com/v4/spreadsheets/1gl_lkZu7E6Bae01ilsGImVlDCMAOY7DAigrtL8EGXCs/values/Tabelle!B2:I100?key=AIzaSyCnSTAG2iRVEHoHK64psjT8soigY0O-1jc");
                        $obj = json_decode($json, true);
                        if (count($obj['values'])) {
                            foreach(array_values($obj['values']) as $i => &$val) { 
                                $empty_arr = array_fill(0, 7, NULL);
                                for ($j = 0; $j < count($val); $j++) { $empty_arr[$j] = $val[$j]; }
                                
                                if ($i == 0) { $tr = '<tr class="success">'; }
                                else if ($i == 1) { $tr = '<tr class="info">'; }
                                else if ($i == 2) { $tr = '<tr class="warning">'; }
                                else { $tr = '<tr>'; }
                                
                                echo $tr . "<td>" . ($i+1) . "</td><td>" . join('</td><td>', $empty_arr) . "</td></tr>";
                            }
                        }
                    ?>
 
                </table>
            </div>
            
            <h2><span class="glyphicon glyphicon-calendar"></span> Schedule</h2>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Datum</th>
                            <th>Ort</th>
                            <th>Beginn</th>
                            <th>Ende</th>
                            <th>Team 1</th>
                            <th>Team 2</th>
                            <th>Score 1</th>
                            <th>Score 2</th>
                            <th>Spirit 1</th>
                            <th>Spirt 2</th>
                        </tr>
                    </thead>
                    <?php
                        $json = file_get_contents("https://sheets.googleapis.com/v4/spreadsheets/1gl_lkZu7E6Bae01ilsGImVlDCMAOY7DAigrtL8EGXCs/values/Scoring!A2:J100?key=AIzaSyCnSTAG2iRVEHoHK64psjT8soigY0O-1jc");
                        $obj = json_decode($json, true);
                        if (count($obj['values'])) {
                            foreach($obj['values'] as &$val) { 
                                $empty_arr = array_fill(0, 10, NULL);
                                for ($i = 0; $i < count($val); $i++) { $empty_arr[$i] = $val[$i]; }

                                $date = date_create_from_format('j.n.y', $val[0]);
                                echo "<tr class='" . ((new Datetime() < $date) ? "future" : "past") . "'><td>" . join('</td><td>', $empty_arr) . "</td></tr>";
                            }
                        }
                    ?>
                </table>
            </div>

            <div class="row">
                <div class="col-xs-offset-0 col-xs-12 col-sm-offset-0 col-sm-6">
                    <h2>Fritz Grassinger Halle</h2>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2659.2912852561367!2d16.327003016422857!3d48.201005079228636!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476d07f98b322c29%3A0x4b267a952a963f2f!2sTellgasse+3%2C+1150+Wien!5e0!3m2!1snl!2sat!4v1475701936683" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <br>
                    <p><span class="glyphicon glyphicon-map-marker"></span> Tellgasse 3, 1150 Wien</p>
                    <p><span class="glyphicon glyphicon-time"></span> Hallenzeit: 21:30-22:30</p>
                    <p><span class="glyphicon glyphicon-hourglass"></span> Spielzeit: 21:40-22:25</p>
                    <p><span class="glyphicon glyphicon-info-sign"></span> Achtung: Bitte den Sportlereingang links neben dem Besuchereingang die Rampe runter verwenden!</p>
                </div>

                <div class="col-xs-offset-0 col-xs-12 col-sm-offset-0 col-sm-6">
                    <h2>Stadthalle B</h2>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2659.2307263145617!2d16.33125686642282!3d48.20217162922869!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476d07fa0a8f5761%3A0x7645f86e440914e3!2sWiener+Stadthalle!5e0!3m2!1snl!2sat!4v1475702457225" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <p><span class="glyphicon glyphicon-map-marker"></span> Roland Rainer Platz 1, 1150 Wien</p>
                    <p><span class="glyphicon glyphicon-time"></span> Hallenzeit: 22:00-23:00</p>
                    <p><span class="glyphicon glyphicon-hourglass"></span> Spielzeit: 22:10-22:55</p>
                    <p><span class="glyphicon glyphicon-info-sign"></span> Eingang über Parkplatz Höhe Voglweidplatz 6</p>
                </div>           
            </div>

        </div>

        <!--
        Der Modus vom B.E.T.T.H.U.P.F.E.R.L. ist fixiert! 9 Teams werden um den 2. Wiener Hallen-Landesmeistertitel werfen.
        Das bedeutet fürs Format:
        45 min NON continuous play, ein Timeout pro Team, nicht in den letzten 5 min. Wenn die Zeit abgelaufen ist wird der Punkt fertig gespielt. 1 Dame auf der Line, auf Wunsch und Einverständnis beider Teams kann für das Spiel auf 1 oder 2 Damen - Offense entscheidet - gewechselt werden.
        Die Teams verpflichten sich selber zu scoren, und score und spirit in folgendes sheet einzutragen:
        https://docs.google.com/…/1xthKp3exLGx5_C3PA_rRF6tfCI…/edit…

        Außerdem nehmt bitte selbst Huterln mit, zB die vom Betthupferl Team Geschenk letztes Jahr ;)
        In diesen Hallen wird jeweils Donnerstags parallel gespielt:
        - Fritz Grassinger Halle, Tellgasse 3, 1150 Wien, Hallenzeit: 21:30-22:30, Spielzeit: 21:40-22:25 (Achtung: Bitte den Sportlereingang links neben dem Besuchereingang die Rampe runter verwenden!)
        - Stadthalle B, Roland Rainer Platz 1, 1150 Wien, Eingang über Parkplatz Höhe Voglweidplatz 6, Hallenzeit: 22:00-23:00, Spielzeit: 22:10-22:55
        Die Hallen sind keine 5 min auseinander, was gemeinsame anschließende Aktivitäten ermöglicht.
        Die Tabelle, die immer nur !vorläufige! Schedule und die !fixierten! "nächsten Spiele" erfahrt ihr auf der Betthupferl Homepage:
        https://sites.google.com/…/chuckbronsonultimate/die-veranst…

        Da sich die MA51 etwas querlegt können wir immer nur einige Spieltermine im Voraus fixieren!!!
        Bis bald,
        Adrian i.V. Stefan Peziner i.V. Chuck Bronson i.V. WFSV
        -->

        <?php include('footer.html'); ?>
        <script>
            $(window).on("load resize", function(e) {
                var image_url = $('#betthupferl').css('background-image'),
                    image,
                    jumbo_width = $('#betthupferl').width();

                // Remove url() or in case of Chrome url("")
                image_url = image_url.match(/^url\("?(.+?)"?\)$/);

                if (image_url[1]) {
                    image_url = image_url[1];
                    image = new Image();

                    // just in case it is not already loaded
                    $(image).load(function () {
                        //console.log(jumbo_width, image.width, image.height);
                        $('#betthupferl').css('padding-top', image.height * (jumbo_width/image.width));
                    });

                    image.src = image_url;
                }
            });
        </script>

        <script type="text/javascript" src="assets/js/ics.deps.min.js"></script>
        <script type="text/javascript" src="assets/js/ics.min.js"></script>
        <script type="text/javascript" src="assets/js/FileSaver.min.js"></script>
        <script type="text/javascript" src="assets/js/Blob.js"></script>
        <script>
            $(document).ready(function() {
                $('.future').click(function() {
                    var datum = $(this).children().eq(0).html(),
                        halle = $(this).children().eq(1).html(),
                        beginn = $(this).children().eq(2).html(),
                        ende = $(this).children().eq(3).html(),
                        team1 = $(this).children().eq(4).html(),
                        team2 = $(this).children().eq(5).html(),
                        cal = ics();

                    cal.addEvent("Betthupferl " + team1 + " - " + team2, "Betthupferl " + team1 + " - " + team2, halle, datum + " " + beginn, datum + " " + ende);
                    //cal.download('betthupferl' + '_' + team1 + '_' + team2);
                });
            });
        </script>

    </body>
</html>