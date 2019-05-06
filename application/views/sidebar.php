<nav class="col-md-2 bg-light sidebar" id="sidebar">
	<div class="sidebar-sticky">
		<ul class="nav flex-column">
			<li class="nav-item">
				<a class="nav-link" data-active="addUser" href="<?echo base_url() ?>admin/nav/proyectos" id="botonAlumno">
					<i class="fas fa-project-diagram fa-lg"></i>
					Mis Proyectos
					<span class="sr-only">(current)</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link " data-active="directorio" href="<?echo base_url() ?>admin/nav/directorio" id="botonAlumno">
					<i class="fas fa-tasks fa-lg"></i>
					Requisitos
					<span class="sr-only">(current)</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?echo base_url() ?>admin/nav/horarios" id="botonHorarios">
					<i class="far fa-calendar-alt fa-lg"></i>
					Horarios
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?echo base_url() ?>admin/nav/configuracion" id="botonConfiguracion">
					<i class="fas fa-tools fa-lg"></i>
					Configuracion
				</a>
			</li>
			<li class="nav-item">
				<a href="<?php echo base_url() ?>login/logout" class="nav-link">
					<i class="fas fa-sign-out-alt fa-lg"></i> Salir
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-active="configuracion" href="<?echo base_url() ?>admin/registro" id="botonConfiguracion">
				<i class="fas fa-user-plus fa-lg"></i>
					Registrar Usuario
				</a>
			</li>
		</ul>
	</div>
</nav>