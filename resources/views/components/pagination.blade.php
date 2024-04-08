<div class="container-xxl">
    <nav aria-label="Page navigation example">
        <div class="row">
            <div class="col-6">
                {{ $data->total() }} total results
            </div>
            <div class="col-6">
                <ul class="pagination justify-content-end">
                    <li class="page-item {{ $data->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $data->previousPageUrl() }}" tabindex="-1" aria-disabled="{{ $data->onFirstPage() ? 'true' : 'false' }}">Previous</a>
                    </li>
                    @for ($i = 1; $i <= $data->lastPage(); $i++)
                        <li class="page-item {{ $i == $data->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $data->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $data->nextPageUrl() }}">Next</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>