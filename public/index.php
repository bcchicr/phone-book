<?php

use Bcchicr\StudentList\App\Application;
use Bcchicr\StudentList\Http\Factory\RequestFactory;
use Bcchicr\StudentList\Controller\StartPageController;
use Bcchicr\StudentList\Http\Response;

require __DIR__ . '/../vendor/autoload.php';


$app = new Application();
$request = $app(RequestFactory::class)->createRequestFromGlobals();

$uri = $request->getUri()->getPath();
if ($uri === '/') {
    $response = (new StartPageController)->index($request);
} else {
    $response = new Response(404, [], 'Not Found');
}

if (headers_sent()) {
    throw new RuntimeException('Headers were already sent. The response could not be emitted');
}
$statusLine = sprintf(
    'HTTP/%s %s %s',
    $response->getProtocolVersion(),
    $response->getStatusCode(),
    $response->getReasonPhrase()
);
header($statusLine, true);
foreach ($response->getHeaders() as $name => $value) {
    $responseHeader = sprintf(
        '%s: %s',
        $name,
        $response->getHeaderLine($name)
    );
    header($responseHeader, false);
}
echo $response->getBody();
exit();
// xdebug_info();
