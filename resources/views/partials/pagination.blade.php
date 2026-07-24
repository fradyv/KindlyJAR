@if ($paginator->hasPages())
  <div class="history-pagination">
    @if ($paginator->onFirstPage())
      <span class="page-nav-btn is-disabled" aria-hidden="true">&lt;</span>
    @else
      <a href="{{ $paginator->previousPageUrl() }}" class="page-nav-btn" aria-label="Halaman sebelumnya">&lt;</a>
    @endif
    <span class="page-num-display">{{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}</span>
    @if ($paginator->hasMorePages())
      <a href="{{ $paginator->nextPageUrl() }}" class="page-nav-btn" aria-label="Halaman berikutnya">&gt;</a>
    @else
      <span class="page-nav-btn is-disabled" aria-hidden="true">&gt;</span>
    @endif
  </div>
@endif
