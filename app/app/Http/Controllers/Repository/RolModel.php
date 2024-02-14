<?php

namespace App\Http\Controllers\Repository;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RolModel extends Controller
{
    public function create($data)
    {
        try {
            $name = $data['name'];
            $description = $data['description'];
            $status = 'active';

            $new_role = Role::create([
                'name' => $name,
                'description' => $description,
                'status' => $status
            ]);

            return [true, $new_role];
        } catch (\Exception $e) {
            return [false, $e];
        }
    }
}
