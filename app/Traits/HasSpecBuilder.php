<?php
namespace App\Traits;

trait HasSpecBuilder {
    protected function build($filter = []){
        $conditions = [];
        if(is_array($filter) && count($filter)){
            foreach($filter as $key => $val){
                if($this->request->has($val)){
                    $conditions[$val] = $this->request->input($val);
                }
            }
        }
        return $conditions;
    }

    protected function specifications(): array {
        return [
            'all' => $this->request->input('type') === 'all',
            'perpage' => $this->request->input('perpage') ?? $this->perpage,
            'filter' => [
                'simple' => $this->build($this->simpleFilter),
                'keyword' => [
                    'q' => $this->request->input('keyword'),
                    'fields' => $this->searchFields,
                    'isMultipleLanguage' => $this->isMultipleLanguage ?? false
                ]
            ]
        ];
    }
}