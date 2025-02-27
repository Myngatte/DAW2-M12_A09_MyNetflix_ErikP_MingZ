// filter.js
document.addEventListener('DOMContentLoaded', () => {
    // Referencias a elementos del DOM
    const filterModal = document.getElementById('filterModal');
    const openFilterModal = document.getElementById('openFilterModal');
    const closeFilterModal = document.getElementById('closeFilterModal');
    const filterNameInput = document.getElementById('filterName');
    const applyFilterBtn = document.getElementById('applyFilter');
    const moviesContainer = document.querySelector('.movies');
  
    // Selecciona todos los botones de géneros
    const genreButtons = document.querySelectorAll('.genre-btn');
  
    // Al hacer clic en un botón de género, se alterna su estado "active"
    genreButtons.forEach(btn => {
      btn.addEventListener('click', () => {
        btn.classList.toggle('active');
      });
    });
  
    // Abrir modal
    openFilterModal.addEventListener('click', () => {
      filterModal.style.display = 'block';
    });
  
    // Cerrar modal
    closeFilterModal.addEventListener('click', () => {
      filterModal.style.display = 'none';
    });
  
    // Función para enviar los filtros y actualizar las películas mediante Ajax
    async function fetchFilteredMovies() {
      const nameValue = filterNameInput.value.trim();
      // Obtener IDs de los géneros seleccionados (botones con clase "active")
      const selectedGenres = Array.from(document.querySelectorAll('.genre-btn.active'))
                                 .map(btn => btn.getAttribute('data-genre'));
  
      try {
        const response = await fetch('./PHP/user/filter.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ name: nameValue, genres: selectedGenres })
        });
  
        if (!response.ok) {
          throw new Error('Error en la comunicación con el servidor.');
        }
  
        const movies = await response.json();
        moviesContainer.innerHTML = '';
  
        movies.forEach(movie => {
          const movieDiv = document.createElement('div');
          movieDiv.classList.add('movie');
          movieDiv.innerHTML = `
            <img src="./IMG/Pelis/${movie.portada}" alt="${movie.nom_peli}">
            <p>${movie.nom_peli}</p>
          `;
          moviesContainer.appendChild(movieDiv);
        });
      } catch (error) {
        console.error(error);
        alert('Ocurrió un error al filtrar las películas.');
      }
    }
  
    // Evento para buscar por nombre
    filterNameInput.addEventListener('keyup', fetchFilteredMovies);
  
    // Evento para aplicar filtro por géneros y cerrar el modal
    applyFilterBtn.addEventListener('click', () => {
      fetchFilteredMovies();
      filterModal.style.display = 'none';
    });
  });
  