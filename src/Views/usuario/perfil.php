<h1>Editar Perfil</h1>

<form action="<?= BASE_URL ?>usuario/actualizarPerfil" method="POST">
  <p>
    <label>Nombre:</label><br>
    <input
      type="text"
      name="data[nombre]"
      value="<?= htmlspecialchars($usuario->getNombre()) ?>"
    >
  </p>

  <p>
    <label>Apellidos:</label><br>
    <input
      type="text"
      name="data[apellidos]"
      value="<?= htmlspecialchars($usuario->getApellidos()) ?>"
    >
  </p>

  <p>
    <label>Email:</label><br>
    <input
      type="email"
      name="data[email]"
      value="<?= htmlspecialchars($usuario->getEmail()) ?>"
    >
  </p>

  <input
    type="hidden"
    name="data[id]"
    value="<?= $usuario->getId() ?>"
  >
  <input
    type="hidden"
    name="data[rol]"
    value="<?= htmlspecialchars($usuario->getRol()) ?>"
  >

  <p>
    <input type="submit" value="Actualizar">
  </p>
</form>