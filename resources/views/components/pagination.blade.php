<div class="container-xxl">
    <nav aria-label="Page navigation example">
        <div class="row">
            <div class="col-6 mb-4">
                {{ $data->total() }} total results
            </div>
            @if ($data->total() > 0)
            <div class="col-6">
                <ul class="pagination justify-content-end">
                    <li class="page-item {{ $data->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $data->previousPageUrl() . ($data->previousPageUrl() ? '&' : '?') . http_build_query(request()->except('page')) }}" tabindex="-1" aria-disabled="{{ $data->onFirstPage() ? 'true' : 'false' }}">Previous</a>
                    </li>
                    @for ($i = 1; $i <= $data->lastPage(); $i++)
                        <li class="page-item {{ $i == $data->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $data->url($i) . ($i == $data->currentPage() & empty(request()->except('page')) ? '' : '&' . http_build_query(request()->except('page'))) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $data->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $data->nextPageUrl() . ($data->nextPageUrl() ? '&' : '?') . http_build_query(request()->except('page')) }}">Next</a>
                    </li>
                </ul>
            </div>
            @endif
        </div>
    </nav>
</div>