<?php

namespace App\Repositories;

use App\Models\Agency\Agency;
use App\Repositories\AgencyRepositoryInterface;
use Illuminate\Support\Facades\Cache;



class AgencyRepository implements AgencyRepositoryInterface
{

    private $model;

    public function __construct(Agency $model)
    {
        $this->model = $model;
    }


    public function all()
    {
        $agencies = $this->model::query()
        ->latest()
        ->get();

        $this->reset();
        return Cache::remember('all_agency_cache', 86400, fn() => $agencies);
    }


    public function create(array $request)
    {

      $storeAgency = $this->model::create($request);
      $this->reset();
      return Cache::remember('agency_cache', 86400, fn() => $storeAgency); 
    }

    public function find($id)
    {
        $agency = $this->model::query()
        ->where('id', $id)
        ->first();

        $this->reset();
        return Cache::remember('agency_cache', 86400, fn() => $agency);
    }

    public function update($id, array $data)
    {
        // $agency = $this->model::query()
        // ->where('id', $id)
        // ->update($data);

        $agency = $this->model->find($id);
        if ($agency) {
            $agency->update($data);
            return $agency;
        }
        return false;

        $this->reset();
        return Cache::remember('agency_cache', 86400, fn() => $agency);
    }

    public function delete($id)
    {
        $agency = $this->model::query()
        ->where('id', $id)
        ->delete();

        $this->reset();
        return Cache::remember('agency_cache', 86400, fn() => $agency);
    }
    

    private function reset() {
        Cache::forget('all_agency_cache');
        cache::forget('agency_cache');
    }


}
