<?php 
namespace App\Traits;
use Illuminate\Support\Carbon;

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

    public function scopeComplexFilter($query, array $filters = [])
    {
        if (count($filters)) {
            foreach ($filters as $field => $condition) {
                if (count($condition)) {
                    foreach ($condition as $operator => $value) {
                        switch ($operator) {
                            case 'gt':
                                $query->where($field, '>', $value);
                                break;
                            case 'gte':
                                $query->where($field, '>=', $value);
                                break;
                            case 'lt':
                                $query->where($field, '<', $value);
                                break;
                            case 'lte':
                                $query->where($field, '<=', $value);
                                break;
                            case 'eq':
                                $query->where($field, '=', $value);
                                break;
                            case 'between':
                                [$min, $max] = explode(',', $value);
                                if(isset($min) && isset($max) && $min < $max){
                                    $query->whereBetween($field, [$min, $max]);
                                }
                                break;
                            case 'in':
                                $in = explode(',', $value);
                                if(isset($in) && count($in)){
                                    $query->whereIn($field, $in);
                                }
                                break;    
                            default:
                                // Bạn có thể thêm xử lý 'like' hoặc các toán tử khác ở đây
                                break;
                        }
                    }
                }
            }
        }

        return $query;
    }


    //d-m-y                            
    public function scopeDateFilter($query, array $filters = [])
    {
        if (count($filters)) {
            foreach ($filters as $field => $condition) {
                if (count($condition)) {
                    foreach ($condition as $operator => $value) {
                        switch ($operator) {
                            case 'gt':
                                $query->where($field, '>', Carbon::parse($value)->startOfDay());
                                break;
                            case 'gte':
                                $query->where($field, '>=', Carbon::parse($value)->startOfDay());
                                break;
                            case 'lt':
                                $query->where($field, '<', Carbon::parse($value)->endOfDay());
                                break;
                            case 'lte':
                                $query->where($field, '<=', Carbon::parse($value)->endOfDay());
                                break;
                            case 'eq':
                                $query->where($field, '=', Carbon::parse($value)->startOfDay());
                                break;
                            case 'between':
                                [$startDate, $endDate] = explode(',', $value);
                                $startDate = Carbon::parse($startDate)->startOfDay();
                                $endDate = Carbon::parse($endDate)->endOfDay();
                                
                                if (isset($startDate) && isset($endDate) && $startDate < $endDate) {
                                    $query->whereBetween($field, [$startDate, $endDate]);
                                }
                                break;
                            default:
                                # code...
                                break;
                        }
                    }
                }
            }
        }

        return $query;
    }

}