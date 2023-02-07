<?php

namespace YjHyperfAdminPligin\Apidog;



use Hyperf\Context\Context;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Validation\Contract\ValidatorFactoryInterface;
use YjHyperfAdminPligin\Apidog\Annotations\ApiParam;

class Validation
{
    #[Inject]
    protected ValidatorFactoryInterface $validationFactory;


    public function Validated($request,$controller, $action,$params)
    {
        $annotations = AnnotationCollector::getClassMethodAnnotation($controller, $action);
        $FormDataAnnotations = collect(collect($annotations)->get(ApiParam::class));

        $FormDataRules = (clone $FormDataAnnotations)->mapWithKeys(function ($item) {
            return [$item->key => $item->rule?:'required'];
        });

        $FormDataMessage =(clone $FormDataAnnotations)->where('message', '!==', null)->mapWithKeys(function ($item) {
            return [$item->key => $item->message];
        });

        $messages = [
            'required' => 'The :attribute is required',
            'same'    => 'The :attribute and :other must match.',
            'size'    => 'The :attribute must be exactly :size.',
            'between' => 'The :attribute value :input is not between :min - :max.',
            'in'      => 'The :attribute must be one of the following types: :values',
        ];
        $validationData = $this->getValidationData($request,$params);
        dump($validationData);
        $validator = $this->validationFactory->make($validationData,$FormDataRules->toArray(),$messages);


        if ($validator->fails()){
            // Handle exception
            $errorMessage = $validator->errors()->first();
            ERROR($errorMessage);
        }

        Context::set('validator.data',$validator->validated() );

        return true;
    }

    protected function getValidationData($request,$params):array
    {

         return array_merge(array_merge_recursive($this->getInputData($request), $request->getUploadedFiles()),$params);
    }

    protected function getInputData($request): array
    {

        return $this->storeParsedData(function ()use ($request) {
            if (is_array($request->getParsedBody())) {
                $data = $request->getParsedBody();
            } else {
                $data = [];
            }

            return array_merge($data, $request->getQueryParams());
        });
    }

        /**
         * @var array the keys to identify the data of request in coroutine context
         */
    protected array $contextkeys
        = [
            'parsedData' => 'http.request.parsedData',
        ];

    protected function storeParsedData(callable $callback): mixed
    {
        if (! Context::has($this->contextkeys['parsedData'])) {
            return Context::set($this->contextkeys['parsedData'], $callback());
        }
        return Context::get($this->contextkeys['parsedData']);
    }
}