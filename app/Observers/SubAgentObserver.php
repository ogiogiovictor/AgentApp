<?php

namespace App\Observers;

use App\Models\Agency\SubAgent;


class SubAgentObserver
{
   

    public function created(SubAgent $subAgent) {
        // Logic after user creation
        $userAttributes = $subAgent->getAttributes(); // Get user attributes
         // Define the mapping between User attributes and SubAgent attributes
         $mapping = [
            'name' => 'name',
            'email' => 'email',
            'agency_id' => 'agency_id',
            'address' => 'address',
            'phone' => 'phone',
            'date_of_engagement' => 'date_of_engagement',
        ];

         // Extract and map the relevant attributes from User to SubAgent
         $subAgentAttributes = [];
         foreach ($mapping as $userAttribute => $subAgentAttribute) {
             if (array_key_exists($userAttribute, $userAttributes)) {
                 $subAgentAttributes[$subAgentAttribute] = $userAttributes[$userAttribute];
             }
         }
 
         // Create a new SubAgent instance with the mapped attributes
         SubAgent::create($subAgentAttributes);
         


    }

    public function updating(SubAgent $subAgent) {
        // Logic before user update
    }

    public function updated(SubAgent $subAgent) {
        // Logic after user update
    }

    public function deleting(SubAgent $subAgent) {
        // Logic before user deletion
    }
}
