<!-- Sticky Delivery Routes Bar -->
<div id="delivery-routes-bar" class="shadow-sm">
    <div class="accordion accordion-flush m-0" id="routesAccordion">
        <div class="accordion-item border-0 m-0">
            <h2 class="accordion-header m-0" id="headingRoutes">
                <button class="accordion-button collapsed px-3"
                        style="background-color: #ffc600; color: #000; font-weight: bold; font-size: 0.95rem;"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#collapseRoutes"
                        aria-expanded="false"
                        aria-controls="collapseRoutes">
                    🚚 Delivery Routes & Days
                </button>
            </h2>
            <div id="collapseRoutes"
                 class="accordion-collapse collapse m-0"
                 aria-labelledby="headingRoutes"
                 data-bs-parent="#routesAccordion">
                <div class="accordion-body py-2 px-3" style="background-color: #fff; font-size: 0.85rem;">
                    <ul class="list-unstyled m-0 p-0">
                        @foreach($routes as $route)
                            <li class="mb-1">
                                📍 <strong>{{ $route->name }}</strong>
                                <span class="badge bg-warning text-dark ms-2">
                                    {{ $route->delivery_day }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                    <small class="text-muted d-block mt-2">
                        *Delivery schedules may vary on public holidays.
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Keep bar always visible under navbar */
#delivery-routes-bar {
    position: sticky;
    top: 100px; /* adjust: navbar+topbar height */
    z-index: 1025;
    background-color: #ffc600;
}

/* Accordion header always tall enough */
#delivery-routes-bar .accordion-button {
    min-height: 48px;      /* visible yellow strip */
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
}

/* Arrow indicator */
#delivery-routes-bar .accordion-button::after {
    width: 1rem;
    height: 1rem;
    content: "";
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='black' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1.5 5.5l6 6 6-6z'/%3E%3C/svg%3E");
    background-size: 1rem;
    transition: transform 0.2s ease-in-out;
}
#delivery-routes-bar .accordion-button:not(.collapsed)::after {
    transform: rotate(180deg);
}
</style>
