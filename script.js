// script.js - lógica simples para interações visuais

// Marca uma resposta como "Certo" ou "Errado" na interface do tutor.
// Não guarda nada em ficheiro ou base de dados; é apenas visual.

document.addEventListener('DOMContentLoaded', () => {
  const markButtons = document.querySelectorAll('.mark-button');

  markButtons.forEach((button) => {
    button.addEventListener('click', (event) => {
      const button = event.currentTarget;
      const card = button.closest('.response-card');
      const status = button.dataset.status;
      const badge = card.querySelector('.status');

      if (!badge) return;

      if (status === 'certo') {
        badge.textContent = 'Certo';
        badge.classList.remove('badge-errado');
        badge.classList.add('badge-certo');
      } else if (status === 'errado') {
        badge.textContent = 'Errado';
        badge.classList.remove('badge-certo');
        badge.classList.add('badge-errado');
      }

      // Realça o cartão para dar feedback visual
      card.classList.add('response-updated');
      setTimeout(() => card.classList.remove('response-updated'), 800);
    });
  });
});
