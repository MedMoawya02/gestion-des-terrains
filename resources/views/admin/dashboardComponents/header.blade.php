<div class="mb-4 d-flex align-items-center justify-content-between">
    <div>
        <h2 class="fw-bold mb-0"><i class="bi bi-graph-up-arrow text-primary me-2"></i>Dashboard</h2>
        <p class="text-muted mb-0">Statistiques en temps réel de la plateforme</p>
    </div>

    <div class="dropdown">
        <div class="position-relative cursor-pointer" data-bs-toggle="dropdown">
            <i class="bi bi-bell fs-4 text-secondary"></i>
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
            @endif
        </div>

        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3" style="width: 300px;">
            <li class="p-2 border-bottom fw-bold">Notifications</li>

            @forelse(auth()->user()->unreadNotifications->take(5) as $notification)
                <li>
                    <a class="dropdown-item p-2 border-bottom" href="{{ $notification->data['url'] }}">
                        <div class="d-flex align-items-center">
                            <i class="bi {{ $notification->data['icone'] }} text-primary me-2"></i>
                            <div>
                                <div class="small fw-bold">{{ $notification->data['titre'] }}</div>
                                <div class="small text-muted">{{ $notification->data['message'] }}</div>
                            </div>
                        </div>
                    </a>
                </li>
            @empty
                <li class="p-3 text-center text-muted small">Aucune nouvelle notification</li>
            @endforelse
        </ul>
    </div>
</div>