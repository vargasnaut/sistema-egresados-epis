<?php
// app/Models/ResponsableModel.php

namespace App\Models;

use CodeIgniter\Model;

class ResponsableModel extends Model
{
    protected $table         = 'responsables_seguimiento';
    protected $primaryKey    = 'id_responsable';
    protected $returnType    = 'array';
    protected $allowedFields = [
        'id_escuela',
        'nombres_apellidos',
        'cargo',
        'correo_institucional',
        'telefono',
        'estado',
    ];
    protected $useTimestamps = false;
}