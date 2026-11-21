<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($titulo) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="h4 mb-1">Seguimiento de Egresados — EPIS (FIIS - UNAC)</h1>
    <p class="text-muted mb-4">HU-16: Catálogo de Escuela Profesional y Responsables de Seguimiento</p>

    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success"><?= esc(session()->getFlashdata('mensaje')) ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $err): ?>
                    <li><?= esc($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card mb-4">
        <div class="card-header fw-bold">Escuela Profesional Activa</div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Escuela Profesional</th>
                        <th>Facultad</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($escuelas as $esc): ?>
                        <tr>
                            <td><?= esc($esc['codigo_escuela']) ?></td>
                            <td><?= esc($esc['nombre_escuela']) ?></td>
                            <td><?= esc($esc['facultad']) ?></td>
                            <td><span class="badge bg-success"><?= esc($esc['estado']) ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header fw-bold">Asignar Responsable de Seguimiento</div>
                <div class="card-body">
                    <form action="<?= base_url('escuelas/responsable/guardar') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Escuela Profesional</label>
                            <select name="id_escuela" class="form-select" required>
                                <?php foreach ($escuelas as $esc): ?>
                                    <option value="<?= esc($esc['id_escuela']) ?>">
                                        <?= esc($esc['codigo_escuela'] . ' - ' . $esc['nombre_escuela']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nombres y Apellidos</label>
                            <input type="text" name="nombres_apellidos" class="form-control" value="<?= old('nombres_apellidos') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cargo</label>
                            <input type="text" name="cargo" class="form-control" value="<?= old('cargo') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Correo Institucional</label>
                            <input type="email" name="correo_institucional" class="form-control" value="<?= old('correo_institucional') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Teléfono (opcional)</label>
                            <input type="text" name="telefono" class="form-control" value="<?= old('telefono') ?>">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Guardar Responsable</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-header fw-bold">Responsables Registrados</div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Cargo</th>
                                <th>Correo</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($responsables as $resp): ?>
                                <tr>
                                    <td><?= esc($resp['nombres_apellidos']) ?></td>
                                    <td><?= esc($resp['cargo']) ?></td>
                                    <td><?= esc($resp['correo_institucional']) ?></td>
                                    <td>
                                        <span class="badge <?= $resp['estado'] === 'ACTIVO' ? 'bg-success' : 'bg-secondary' ?>">
                                            <?= esc($resp['estado']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($resp['estado'] === 'ACTIVO'): ?>
                                            <a href="<?= base_url('escuelas/responsable/estado/' . $resp['id_responsable'] . '/INACTIVO') ?>" class="btn btn-sm btn-outline-secondary">Inactivar</a>
                                        <?php else: ?>
                                            <a href="<?= base_url('escuelas/responsable/estado/' . $resp['id_responsable'] . '/ACTIVO') ?>" class="btn btn-sm btn-outline-success">Activar</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>