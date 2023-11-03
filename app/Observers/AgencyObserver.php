<?php

namespace App\Observers;

use App\Models\Agency\Agency;
use App\Helpers\UniqueNo;
use Illuminate\Support\Facades\DB;

class AgencyObserver
{
    public function creating(Agency $agency) {
        // Logic before user creation
        $agency->agency_code = (new UniqueNo)->generate(fn($companyNo) => DB::table('agency')->select('agency_code')->where('agency_code', $companyNo)->exists(), 15, true, 'AGT' );
    }

    public function created(Agency $agency) {
        // Logic after user creation
    }

    public function updating(Agency $agency) {
        // Logic before user update
    }

    public function updated(Agency $agency) {
        // Logic after user update
    }

    public function deleting(Agency $agency) {
        // Logic before user deletion
    }
}
