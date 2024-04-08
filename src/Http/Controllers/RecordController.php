<?php

namespace Bcchicr\Framework\Http\Controllers;

use Bcchicr\Framework\App\JsonMapper;
use Bcchicr\Framework\Http\Foundation\Factory\ResponseFactory;
use Bcchicr\Framework\Http\Foundation\Request;
use Bcchicr\Framework\Views\View;
use stdClass;

final class RecordController
{
    public function __construct(
        private JsonMapper $jsonMapper,
        private ResponseFactory $responseFactory
    ) {
    }

    public function index()
    {
        $records = $this->jsonMapper->getValue();

        return $this->responseFactory
            ->createResponse()
            ->withBody(
                View::get(
                    'records/index.php',
                    compact('records')
                )
            );
    }
    public function delete(Request $request)
    {
        $id = $request->getQuery()['id'];
        $this->jsonMapper->deleteRecord($id);

        return $this->responseFactory->createRedirectResponse('/');
    }

    public function create()
    {
        return $this->responseFactory
            ->createResponse()
            ->withBody(
                View::get(
                    'records/create.php',
                )
            );
    }
    public function store(Request $request)
    {
        $input = $request->getParsedBody();

        $record = new stdClass();
        $record->firstName = $input['first-name'];
        $record->lastName = $input['last-name'];
        $record->phoneNumber = $input['phone-number'];

        $this->jsonMapper->addRecord($record);

        return $this->responseFactory->createRedirectResponse('/');
    }
}
