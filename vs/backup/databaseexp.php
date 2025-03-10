<?php

$SERVER="23.111.168.178";
$DBUSER="codemax2_fiewin";
$DBPASSWD="codemax2_fiewin";
$DATABASE="codemax2_fiewin";

$filename = "backup-" . date("d-m-Y") . ".sql.gz";
$mime = "application/x-gzip";

header( "Content-Type: " . $mime );
header( 'Content-Disposition: attachment; filename="' . $filename . '"' );

$cmd = "mysqldump -u $DBUSER --password=$DBPASSWD $DATABASE | gzip --best";   

passthru( $cmd );

exit(0);
?>