<?php 

namespace App\Interfaces;

interface AuthServiceInterface
 {

    public function login (int $id) : void;
    public function logout () : void;
    public function isLoggedIn () : bool;
}