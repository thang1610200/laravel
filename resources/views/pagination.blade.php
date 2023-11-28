@if ($ticket->lastPage() >= 2)
<nav aria-label="..." class="d-flex justify-content-center">
    <ul class="pagination">
        <li class="page-item @if ($ticket->onFirstPage()) disabled @endif">
            <button class="page-link" page="{{ $ticket->previousPageUrl() }}">Previous</button>
        </li>
        @for ($i = 1; $i <= $ticket->lastPage(); $i++)
            <li class="page-item @if ($i === $ticket->currentPage()) active @endif"><button class="page-link"
                    page="{{ $ticket->url($i) }}">{{ $i }}</button></li>
        @endfor

        <li class="page-item @if ($ticket->onLastPage()) disabled @endif">
            <button class="page-link" page="{{ $ticket->nextPageUrl() }}">Next</button>
        </li>
    </ul>
</nav>
@endif
