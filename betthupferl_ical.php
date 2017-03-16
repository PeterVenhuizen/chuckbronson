<?php

    # date, start_time, end_time, location, match-up
    if (isset($_POST['date']) && isset($_POST['start_time']) && isset($_POST['end_time']) && isset($_POST['location']) && isset($_POST['match'])) {
        
        $date = date('Ymd', $_POST['date']);
        $start_time = date('Gis', $start_time);
        $end_time = date('Gis', $end_time);

        $ical = "BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//Chuck Bronson//Betthupferl//DE\n
BEGIN:VEVENT
UID:" . md5(uniqid(mt_rand(), true)) . "petervenhuizen.nl/chuckbronson
DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "
DTSTART:" . $date . "T" . $start_time . "
DTEND:" . $date . "T" . $end_time . "
SUMMARY:" . $_POST['match'] . "
LOCATION:" . ( $_POST['location'] == "TG" ? "Tellgasse 3, 1150 Wien" : "Roland Rainer Platz 1, 1150 Wien" ) . "
END:VEVENT\n
END:VCALENDAR";

        //set correct content-type-header
        header('Content-type: text/calendar; charset=utf-8');
        header('Content-Disposition: inline; filename="agenda.ics"');
        echo $ical;
        
    } else {
		?>
			<script type='text/javascript'>
				history.go(-1);
			</script>
		<?php
	}

?>