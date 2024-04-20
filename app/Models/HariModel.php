<?php

namespace App\Models;

use CodeIgniter\Model;

class HariModel extends Model
{
    protected $table = 'hari';
    protected $allowedFields = ['nama', 'jam_masuk', 'jam_keluar', 'status'];

}