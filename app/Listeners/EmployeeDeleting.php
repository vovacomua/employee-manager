<?php

namespace App\Listeners;

use App\Employee;
use App\Events\EmployeeDeleting as EmployeeDeletingEvent;

class EmployeeDeleting
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\EmployeeDeletingEvent $event
     * @return mixed
     */
    public function handle(EmployeeDeletingEvent $event)
    {
        $parent_id = $event->employee->parent_id;

        $children = $event->employee->children()->get();

        if ($children){
            $employee_parent_id = (isset($parent_id) ? $parent_id : null);

                foreach ($children->chunk(50) as $chunk) {
                    foreach ($chunk as $child) {
                        if ($employee_parent_id){
                            $child->makeChildOf($employee_parent_id);
                        } else {
                            $child->makeRoot();
                        }
                        
                    }
                }

        }

    }
}