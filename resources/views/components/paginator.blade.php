<?php
/** @see params: */
$link_limit = 1000; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>

@if ($paginator->lastPage() > 1)
<nav aria-label="Page navigation example">
    <ul

        @class([
    'large' => isset($size) && $size == 'large',
    'medium' => isset($size) && $size == 'medium',
    'small' => !isset($size),
    'radius' => isset($border) && $border == 'radius',
    'no-radius' => isset($border) && $border == 'no-radius',
    'center' => isset($center) && $center == 'center',
    'pagination m-0'
    ])
    >

    <li class="page-item">
        @if ($paginator->currentPage() == 1)
        <span class="page-link disabled text-secondary">
      Перша
  </span>
        @else
        <a class="page-link" href="{{ $paginator->url(1) }} {{ $pagiAdditionalUri }}">
            Перша
        </a>
        @endif
    </li>

    <li class="page-item">
        @if ($paginator->currentPage() == 1)
        <span class="page-link disabled text-secondary">← Попередня</span>
        @else
        <a class="page-link" href="{{ $paginator->previousPageUrl() }} {{ $pagiAdditionalUri }}">← Попередня</a>
        @endif
    </li>

    <!-- <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
<a class="page-link" href="{{ $paginator->previousPageUrl() }} {{ $pagiAdditionalUri }}">← Попередня</a>
</li> -->
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
    <?php
    $half_total_links = floor($link_limit / 2);
    $from = $paginator->currentPage() - $half_total_links;
    $to = $paginator->currentPage() + $half_total_links;
    if ($paginator->currentPage() < $half_total_links) {
        $to += $half_total_links - $paginator->currentPage();
    }
    if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
        $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
    }
    ?>
    @if ($from < $i && $i < $to)
    <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
        <a class="page-link" href="{{ $paginator->url($i) }} {{ $pagiAdditionalUri }}">{{ $i }}</a>
    </li>
    @endif
    @endfor

    <!-- <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
<a class="page-link" href="{{ $paginator->nextPageUrl() }} {{ $pagiAdditionalUri }}">наступна →</a>
</li> -->
    <!-- <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
<a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }} {{ $pagiAdditionalUri }}">Остання</a>
</li> -->

    <li class="page-item">
        @if ($paginator->currentPage() == $paginator->lastPage())
        <span class="page-link disabled text-secondary"> наступна →</a>
            @else
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }} {{ $pagiAdditionalUri }}">Наступна →</a>
                @endif
    </li>

    <li class="page-item">
        @if ($paginator->currentPage() == $paginator->lastPage())
        <span class="page-link disabled text-secondary">
      Остання
  </span>
        @else
        <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }} {{ $pagiAdditionalUri }}">
            Остання
        </a>
        @endif
    </li>
    </ul>
</nav>
@endif
