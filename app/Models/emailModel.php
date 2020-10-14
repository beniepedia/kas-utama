<?php

namespace App\Models;

use CodeIgniter\Model;

class emailModel extends Model
{
    protected $table      = 'email';
    protected $primaryKey = 'id';

    protected $returnType = 'object';

    protected $allowedFields = ['protocol', 'host', 'user', 'password', 'port', 'secure', 'mailtype', 'is_register'];

    protected $useTimestamps = false;

    public static function get()
    {
        $db = new emailModel();
        return $db->first();
    }
}
