 <div class="modal fade" id="reservationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">

                <form method="POST" action="{{ route('createReservation') }}">
                    @method('POST')
                    @csrf

                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold">
                            Réserver : <span id="terrainNom"></span>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <!-- Hidden terrain_id -->
                        <input type="hidden" name="terrain_id" id="terrainId">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Prix (DH)</label>
                            <input type="text" id="terrainPrix" name="prix_par_heure" class="form-control rounded-pill" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Date</label>
                            <input type="date" name="date" value="{{ request('date', date('Y-m-d')) }}"
                                onchange="window.location.href='/terrains?date=' + this.value + '&openModal=' + document.getElementById('terrainId').value + '#terrains'"
                                class="form-control rounded-pill" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Heure début</label>
                            <select name="heure_debut" id="heure_debut_select" class="form-select rounded-pill" required>
                                @for($h = 8; $h <= 22; $h++)
                                    <option value="{{ $h }}:00">{{ $h }}h</option>
                                @endfor
                            </select>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" class="btn btn-success rounded-pill w-100">
                                Confirmer réservation
                            </button>
                        </div>

                </form>

            </div>
        </div>
    </div>