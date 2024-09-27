<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    /**
     * Display a list of users
     */
    public function users() {
        try {
            $title = "Users List";
            $users = User::orderBy('created_at', 'DESC')->where('role', Role::ADMIN)->get();
            return response()->view('admin.users', get_defined_vars());
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }

    /**
     * Display a list of customers
     */
    public function customers() {
        try {
            $title = "Customers List";
            $customers = User::orderBy('created_at', 'DESC')->where('role', Role::CUSTOMER)->get();
            return response()->view('admin.customers', get_defined_vars());
        } catch (\Exception $e) {
            return response($e->getMessage());
        }
    }
}
