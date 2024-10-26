/*=============== SHOW SIDEBAR ===============*/
const showSidebar = (toggleId, sidebarId, headerId, mainId) => {
    const toggle = document.getElementById(toggleId),
        sidebar = document.getElementById(sidebarId),
        header = document.getElementById(headerId),
        main = document.getElementById(mainId)
 
    if(toggle && sidebar && header && main) {
        toggle.addEventListener('click', () => {
            /* Show sidebar */
            sidebar.classList.toggle('show-sidebar')
            /* Add padding header */
            header.classList.toggle('left-pd')
            /* Add padding main */
            main.classList.toggle('left-pd')
        })
    }
 }
 showSidebar('header-toggle','sidebar', 'header', 'main')
 
 /*=============== LINK ACTIVE ===============*/
 const sidebarLink = document.querySelectorAll('.sidebar__list a')
 
 function linkColor(){
    sidebarLink.forEach(l => l.classList.remove('active-link'))
    this.classList.add('active-link')
 }
 
 sidebarLink.forEach(l => l.addEventListener('click', linkColor))
 
 // Elementos del menú y el main
 const links = document.querySelectorAll('.sidebar__link');
 const main = document.getElementById('main');

// Contenidos por página
const pageContent = {
    dashboard: '',
    wallet: '',
    calendar: '',
    transactions: '',
    statistics: '',
    settings: '',
    messages: '',
    notifications: ''
}; 

// Función para cambiar contenido del main
function changePage(content, isHTML = false) {
    if (isHTML) {
        main.innerHTML = content;
    } else {
        main.innerHTML = pageContent[content];
    }
}

// Asignar eventos de clic a cada enlace del menú
links.forEach(link => {
    link.addEventListener('click', (event) => {
        event.preventDefault();
        links.forEach(l => l.classList.remove('active-link'));
        link.classList.add('active-link');
        
        const page = link.getAttribute('data-page');

        if (page === 'dashboard') {
            fetch('assets/php/get_tablero.php')
            .then(response => response.json())
            .then(data => {
                changePage('<canvas id="gradesChart" width="400" height="200"></canvas>', true);
                renderChart(data);
            })
            .catch(error => console.error('Error cargando los datos:', error));
        } else if (page === 'wallet') {
            fetch('assets/php/get_alumnos.php')
                .then(response => response.text())
                .then(data => {
                    changePage(data, true);
                })
                .catch(error => console.error('Error cargando los datos:', error));
        } else if (page === 'calendar') {
            fetch('assets/php/get_profesores.php')
                .then(response => response.text())
                .then(data => {
                    changePage(data, true);
                })
                .catch(error => console.error('Error cargando los datos:', error));
        } else if (page === 'transactions') {
            fetch('assets/php/get_carreras.php')
                .then(response => response.text())
                .then(data => {
                    changePage(data, true);
                })
                .catch(error => console.error('Error cargando los datos:', error));
        } else if (page === 'statistics') {
            fetch('assets/php/get_asignaturas.php')
                .then(response => response.text())
                .then(data => {
                    changePage(data, true);
                })
                .catch(error => console.error('Error cargando los datos:', error));
        } else if (page === 'notifications') {
            fetch('assets/php/get_notas.php')
                .then(response => response.text())
                .then(data => {
                    changePage(data, true);
                })
                .catch(error => console.error('Error cargando los datos:', error));
        } else if (page === 'settings') {
            fetch('assets/php/get_configuracion.php')
                .then(response => response.text())
                .then(data => {
                    changePage(data, true);
                })
                .catch(error => console.error('Error cargando los datos:', error));
        } else if (page === 'messages') {
            fetch('assets/php/get_inscripciones.php')
                .then(response => response.text())
                .then(data => {
                    changePage(data, true);
                    
                    // Selecciona el formulario una vez que se cargue el contenido
                    const form = main.querySelector('form');
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        
                        fetch('assets/php/get_inscripciones.php', {
                            method: 'POST',
                            body: new FormData(form)
                        })
                        .then(response => response.text())
                        .then(result => {
                            changePage(result, true);
                            showNotification("Datos ingresados exitosamente.", true);
                        })
                        .catch(error => {
                            console.error('Error al enviar el formulario:', error);
                            showNotification("Error al ingresar los datos.", false);
                        });
                    });
                })
                .catch(error => console.error('Error cargando los datos:', error));
        }
        
    });

    function showNotification(message, isSuccess = true) {
        const notification = document.createElement('div');
        notification.className = `notification ${isSuccess ? 'success' : 'error'}`;
        notification.innerText = message;
        
        // Estilos de la notificación
        Object.assign(notification.style, {
            position: 'fixed',
            bottom: '20px',
            right: '20px',
            backgroundColor: isSuccess ? '#4CAF50' : '#f44336',
            color: 'white',
            padding: '15px',
            borderRadius: '5px',
            boxShadow: '0 4px 8px rgba(0, 0, 0, 0.2)',
            zIndex: '1000'
        });
        
        document.body.appendChild(notification);
        
        // Eliminar la notificación después de 3 segundos
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
});


function renderChart(data) {
    const ctx = document.getElementById('gradesChart').getContext('2d');

    // Procesar los datos para Chart.js
    const labels = data.map(item => item.NombreCompleto); // Usar nombres completos en lugar de ID
    const averages = data.map(item => item.Promedio);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Promedio Académico',
                data: averages,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 10 // Suponiendo que el promedio máximo es 10
                }
            },
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });
}
