<?php
// app/Models/EscuelaModel.php

namespace App\Models;

use CodeIgniter\Model;

class EscuelaModel extends Model
{
    protected $table         = 'escuelas_profesionales';
    protected $primaryKey    = 'id_escuela';
    protected $returnType    = 'array';
    protected $allowedFields = [
        'codigo_escuela',
        'nombre_escuela',
        'facultad',
        'estado',
    ];
    protected $useTimestamps = false;
}