<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body">
        <form action="{{ route('historique') }}" method="GET" class="row g-3">
            <div class="col-md-3">
                <label class="form-label small fw-bold text-uppercase text-muted">Rechercher</label>
                <input type="text" name="search" class="form-control rounded-3" placeholder="Nom du client, terrain...">
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-bold text-uppercase text-muted">Statut</label>
                <select name="status" class="form-select rounded-3">
                    <option value="">Tous les statuts</option>
                    <option value="confirme">Confirmé</option>
                    <option value="en_attente">En attente</option>
                    <option value="annule">Annulé</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold text-uppercase text-muted">Date</label>
                <input type="date" name="date" class="form-control rounded-3">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-dark w-100 rounded-3">Filtrer</button>
            </div>
        </form>
    </div>
</div>