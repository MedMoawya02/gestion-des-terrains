<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let modalEl = document.getElementById('reservationModal');
        let bootstrapModal = new bootstrap.Modal(modalEl);
        let occupations = @json($heuresReservees); // On passe les données PHP à JS

        // 1. Logique d'ouverture classique
        modalEl.addEventListener('show.bs.modal', function (e) {
            let button = e.relatedTarget;
            if (button) {
                updateModalData(button.getAttribute('data-id'), button.getAttribute('data-nom'),button.getAttribute('data-prix'));
            }
        });

        function updateModalData(id, nom,prix) {
            document.getElementById('terrainId').value = id;
            document.getElementById('terrainNom').textContent = nom;
            document.getElementById('terrainPrix').value = prix;

            // Mise à jour des heures disponibles pour ce terrain
            let select = document.getElementById('heure_debut_select');
            let terrainOccupations = occupations[id] || [];

            Array.from(select.options).forEach(option => {
                if (terrainOccupations.includes(option.value)) {
                    option.disabled = true;
                    option.text = option.value.replace(':00', 'h') + " (🚫 Réservé)";
                } else {
                    option.disabled = false;
                    option.text = option.value.replace(':00', 'h');
                }
            });
        }

        // 2. Auto-réouverture si on a changé la date
        const urlParams = new URLSearchParams(window.location.search);
        const openModalId = urlParams.get('openModal');
        if (openModalId) {
            // On trouve le bouton qui correspond à ce terrain pour simuler le clic
            let btn = document.querySelector(`[data-id="${openModalId}"]`);
            if (btn) {
                updateModalData(openModalId, btn.getAttribute('data-nom'),btn.getAttribute('data-prix'));
                bootstrapModal.show();
            }
        }
    });
</script>