<?php

namespace Bcchicr\Framework\Http\Controllers;

use Bcchicr\Framework\App\JsonMapper;
use Bcchicr\Framework\Http\Controllers\Validator\Validator;
use Bcchicr\Framework\Http\Foundation\Factory\ResponseFactory;
use Bcchicr\Framework\Http\Foundation\Request;
use Bcchicr\Framework\Models\Record;
use Bcchicr\Framework\Views\View;

final class RecordController
{
    public function __construct(
        private JsonMapper $jsonMapper,
        private ResponseFactory $responseFactory,
        private Validator $validator
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
        $rawInput = $request->getParsedBody();
        $validatedInput = [];

        $validatedInput['first-name'] = $this->validator->validate(
            $rawInput,
            'first-name',
            "required"
        );
        $validatedInput['last-name'] = $this->validator->validate(
            $rawInput,
            'last-name',
            "required"
        );
        $validatedInput['phone-number'] = $this->validator->validate(
            $rawInput,
            'phone-number',
            "required"
        );

        $errors = $this->validator->getErrors();
        if (count($errors) > 0) {
            session_start();
            $_SESSION['errors'] = $errors;
            return $this->responseFactory
                ->createRedirectResponse('/records/create');
        }


        $record = new Record(
            $validatedInput['first-name'],
            $validatedInput['last-name'],
            $validatedInput['phone-number']
        );

        $this->jsonMapper->addRecord($record);

        return $this->responseFactory
            ->createRedirectResponse('/');
    }
}
