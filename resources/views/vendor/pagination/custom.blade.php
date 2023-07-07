@if ($paginator->hasPages())
    <div class="pagination-outer">
        <ul class="pagination custom-pagination">
        
            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><a class="page-link" href="javascript:void(0)">Prev</a></li>
                <li class="page-item disabled"><a class="page-link" href="javascript:void(0)" rel="prev">First</a></li>
            @else
                <li><a href="{{ @$paginator->url($page)  }}" rel="prev">First</a></li>
                <li class="page-item "><a class="page-link" href="{{ $paginator->previousPageUrl() }}">Prev</a></li>

            @endif


        
            @foreach ($elements as $element)
            
                @if (is_string($element))
                    <li class="page-item disabled"><a class="page-link" href="javascript:void(0)">{{ $element }}</a></li>
                @endif


            
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><a class="page-link" href="javascript:void(0)">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach


            
            @if ($paginator->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a></li>
                <li><a href="{{ $paginator->url($page) }}" rel="next">Last</a></li>
            @else
                <li class="page-item disabled"><a class="page-link" href="javascript:void(0)">Next</a></li>
                <li class="page-item disabled"><a class="page-link" href="javascript:void(0)" rel="next">Last</a></li>
            @endif
        </ul>
    </div>
@endif 
