// like.js

document.addEventListener('DOMContentLoaded', () => {
    const likeBtn = document.getElementById('likeBtn');
    if(likeBtn) {
      likeBtn.addEventListener('click', async function() {
        const movieId = this.dataset.movieId;
        try {
          const response = await fetch('../PHP/user/like.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ movieId: movieId })
          });
          const result = await response.json();
          if(result.success) {
            if(result.liked) {
              likeBtn.innerHTML = '<i class="fas fa-heart"></i>';
            } else {
              likeBtn.innerHTML = '<i class="far fa-heart"></i>';
            }
            // Actualizar el contador de likes, si existe un elemento con id="likeCount"
            const likeCountEl = document.getElementById('likeCount');
            if(likeCountEl) {
              likeCountEl.textContent = result.likeCount;
            }
          } else {
            console.error(result.message);
            alert(result.message);
          }
        } catch (error) {
          console.error('Error al procesar el like:', error);
        }
      });
    }
});
