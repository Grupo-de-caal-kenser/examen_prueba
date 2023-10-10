import { validarFormulario, Toast } from "../funciones";

const formLogin = document.querySelector('form');
const show_password = document.getElementById('show_password');


//!Funcion para mostrar la contraseña al usuario
function ver_password() {
    const passwordInput = document.getElementById("usu_password");
    const showPasswordCheckbox = document.getElementById("show_password");

    if (showPasswordCheckbox.checked) {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}

//!Funcion deL login
const login = async e => {
    e.preventDefault();

    if (!validarFormulario(formLogin)) {
        Toast.fire({
            icon: 'info',
            title: 'Debe llenar todos los campos'
        });
        return;
    }

    try {
        const url = '/examen_prueba/API/login';
        const body = new FormData(formLogin);
        const headers = new Headers();
        headers.append("X-Requested-With", "fetch");
        const config = {
            method: 'POST',
            headers,
            body
        };
        const respuesta = await fetch(url, config);
        const data = await respuesta.json();

        const { codigo, mensaje, detalle } = data;
        let icon = 'info';

        if (codigo == 1) {
            icon = 'success';
            Toast.fire({
                title: mensaje,
                icon
            }).then((e) => {
                location.href = '/examen_prueba/menuAdministrador'; 
            });
        } else if (codigo == 2) {
                icon = 'success'; 
                Toast.fire({
                    title: mensaje,
                    icon
                }).then((e) => {
                    location.href = '/examen_prueba/menuTecnico'; 
                });
        } else if (codigo == 3) {
            icon = 'success'; 
            Toast.fire({
                title: mensaje,
                icon
            }).then((e) => {
                location.href = '/examen_prueba/menuCliente'; 
            });
        } else if (codigo == 4) {
            icon = 'error'; 
            Toast.fire({
                title: mensaje,
                icon
            });
        } else {
            icon = 'error';
            Toast.fire({
                title: mensaje,
                icon
            });
        }
    } catch (error) {
        console.log(error);
    }
}


formLogin.addEventListener('submit', login );
show_password.addEventListener('click', ver_password);