<?php

namespace App\Events;

use App\Employee;
use Illuminate\Queue\SerializesModels;

class EmployeeDeleting
{
    use SerializesModels;

    public $employee;

    /**
     * Create a new event instance.
     *
     * @param \App\Employee $employee
     */
    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }
}