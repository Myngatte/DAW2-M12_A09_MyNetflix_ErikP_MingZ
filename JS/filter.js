// filter.js
document.addEventListener('DOMContentLoaded', () => {
  const filterModal = document.getElementById('filterModal');
  const openFilterModal = document.getElementById('openFilterModal');
  const closeFilterModal = document.getElementById('closeFilterModal');
  const filterNameInput = document.getElementById('filterName');
  const applyFilterBtn = document.getElementById('applyFilter');
  const moviesContainer = document.querySelector('.movies');
  
  const genreButtons = document.querySelectorAll('.genre-btn');
  genreButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      btn.classList.toggle('active');
    });
  });
  
  openFilterModal.addEventListener('click', () => {
    filterModal.style.display = 'block';
  });
  
  closeFilterModal.addEventListener('click', () => {
    filterModal.style.display = 'none';
  });
  
  async function fetchFilteredMovies() {
    const nameValue = filterNameInput.value.trim();
    const selectedGenres = Array.from(document.querySelectorAll('.genre-btn.active'))
                                .map(btn => btn.getAttribute('data-genre'));
    
    // Si no hay filtros, recargamos la página para restaurar la vista con secciones
    if (nameValue === '' && selectedGenres.length === 0) {
      location.reload();
      return;
    }
  
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
      moviesContainer.classList.add('flat-view');  // Aplica layout "flat"
  
      if (movies.length > 0) {
        movies.forEach(movie => {
          const movieDiv = document.createElement('div');
          movieDiv.classList.add('movie');
          movieDiv.innerHTML = `
            <a href="./view/movie.php?id=${movie.id_peli}">
              <img src="./IMG/Pelis/${movie.portada}" alt="${movie.nom_peli}">
              <p>${movie.nom_peli}</p>
              <span class="likes-tooltip">Likes: ${movie.likes}</span>
            </a>
          `;
          moviesContainer.appendChild(movieDiv);
        });
      } else {
        moviesContainer.innerHTML = `<p>No se encontraron resultados.</p>`;
      }
    } catch (error) {
      console.error(error);
      alert('Ocurrió un error al filtrar las películas.');
    }
  }
  
  // Evento en tiempo real al escribir
  filterNameInput.addEventListener('keyup', fetchFilteredMovies);
  // Evento para aplicar filtro desde el modal
  applyFilterBtn.addEventListener('click', () => {
    fetchFilteredMovies();
    filterModal.style.display = 'none';
  });
});
