<?php 
namespace App\Traits;

trait HasQuery{
    public function scopeSimpleFilter($query, array $filters = []){
        if(is_array($filters) && count($filters)){
            foreach($filters as $field => $value){
                if(!empty($value) && $value != 0 && !is_null($value)){
                    $query->where($field, $value);
                }
            }
        }
        return $query;
    }

    public function scopeKeyword($query, $keyword = [])
    {
        if (isset($keyword['q']) && !is_null($keyword['q'])) {
            if (!$keyword['isMultipleLanguage']) {
                $query->where(function ($q) use ($keyword) {
                    foreach ($keyword['fields'] as $field) {
                        $q->orWhere($field, 'LIKE', '%' . $keyword['q'] . '%');
                    }
                });
            } else {
                $query->whereHas('languages', function ($q) use ($keyword) {
                    $q->where(function ($subQuery) use ($keyword) {
                        foreach ($keyword['fields'] as $field) {
                            $subQuery->orWhere($field, 'LIKE', '%' . $keyword['q'] . '%');
                        }
                    });
                });
            }
        }
        return $query;
    }


}