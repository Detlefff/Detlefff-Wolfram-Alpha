<?php
require_once 'lib/wa_wrapper/WolframAlphaEngine.php';

class wolframalpha extends Script
{
	private $appID = '';

    protected $helpMessage = "'wolfram EXPRESSION'\n'wolframalpha EXPRESSION'\n'wa EXPRESSION'";
    protected $description = 'Return the definition of the given expression from Wolfram|Alpha';

    public function run()
    {
		$engine = new WolframAlphaEngine($this->appID);

		$response = $engine->getResults($this->matches[1]);

		if ( $response->isError() ) {
			echo 'ERROR';
			return $this->send('There was an error while communicating with Wolfram|Alpha.');
		}

		if ( count($response->getPods()) > 0 ) {
			$resultMessage = '';
			foreach ( $response->getPods() as $pod ) {
				foreach ( $pod->getSubpods() as $subpod ) {
					//$caption = $pod->attributes['title'] . "\n" . $subpod->plaintext;
					//$this->send($subpod->image->attributes['src'], 'image', '', $caption);

					$resultMessage .= $pod->attributes['title'] . ":\n" . $subpod->plaintext . "\n\n";
				}
			}
			$this->send($resultMessage);
		}
    }
}
