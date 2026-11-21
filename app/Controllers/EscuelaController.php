<?php

namespace App\Controllers;

use App\Models\EscuelaModel;
use App\Models\ResponsableModel;

class EscuelaController extends BaseController
{
    public function index()
    {
        $escuelaModel     = new EscuelaModel();
        $responsableModel = new ResponsableModel();

        $data = [
            'titulo'       => 'Catálogo - Escuela Profesional de Ingeniería de Sistemas',
            'escuelas'     => $escuelaModel->findAll(),
            'responsables' => $responsableModel
                ->select('responsables_seguimiento.*, escuelas_profesionales.codigo_escuela, escuelas_profesionales.nombre_escuela')
                ->join('escuelas_profesionales', 'escuelas_profesionales.id_escuela = responsables_seguimiento.id_escuela')
                ->findAll(),
        ];

        return view('escuelas/index', $data);
    }

    public function guardarResponsable()
    {
        $responsableModel = new ResponsableModel();

        $rules = [
            'id_escuela'           => 'required|integer',
            'nombres_apellidos'    => 'required|min_length[3]|max_length[150]',
            'cargo'                => 'required|min_length[3]|max_length[100]',
            'correo_institucional' => 'required|valid_email|max_length[120]',
            'telefono'             => 'permit_empty|max_length[20]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $responsableModel->insert([
            'id_escuela'           => $this->request->getPost('id_escuela'),
            'nombres_apellidos'    => trim($this->request->getPost('nombres_apellidos')),
            'cargo'                => trim($this->request->getPost('cargo')),
            'correo_institucional' => trim($this->request->getPost('correo_institucional')),
            'telefono'             => trim((string) $this->request->getPost('telefono')),
            'estado'               => 'ACTIVO',
        ]);

        return redirect()->to(base_url('escuelas'))->with('mensaje', 'Responsable de seguimiento asignado correctamente.');
    }

    public function cambiarEstadoResponsable($id, $estado)
    {
        if (! in_array($estado, ['ACTIVO', 'INACTIVO'], true)) {
            return redirect()->to(base_url('escuelas'))->with('error', 'Estado no válido.');
        }

        $responsableModel = new ResponsableModel();
        $responsableModel->update($id, ['estado' => $estado]);

        return redirect()->to(base_url('escuelas'))->with('mensaje', 'Estado del responsable actualizado.');
    }
}