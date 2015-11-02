<?php
require_once 'lib/wa_wrapper/WolframAlphaEngine.php';

$appID = '';

$engine = new WolframAlphaEngine($appID);

$response = $engine->getResults('SEARCHSTRING');

if ( $response->isError() ) {
	echo 'ERROR';
	//return $this->send('There was an error while communicating with Wolfram|Alpha.');
}

if ( count($response->getPods()) > 0 ) {
	foreach ( $response->getPods() as $pod ) {
		//print_r($pod);
		echo $pod->attributes['title'] . "\n\r";

		foreach ( $pod->getSubpods() as $subpod ) {
			print_r($subpod);
		}
	}
}

?>
