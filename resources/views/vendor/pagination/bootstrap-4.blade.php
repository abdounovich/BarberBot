<style>

    body{
    
    background:url(https://res.cloudinary.com/ds9qfm1ok/image/upload/v1599670310/1_zvsdhh.jpg) ;background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    
    font-family: 'Cairo', sans-serif;
}
    .bg-premier{
background-color:{{Setting::get('theme.premier')}};

    }


   
    .btn-premier{
      background-color:{{Setting::get('theme.premier')}};
    }
 


    .bg-deuxieme{
background-color:{{Setting::get('theme.deuxieme')}};

    }


  
    .btn-deuxieme{
      background-color:{{Setting::get('theme.deuxieme')}};
    
    }
 
    .text-color{
      color:{{Setting::get('theme.text-color')}};
    }
 
 

    .text-premier{
      color:{{Setting::get('theme.premier')}};
    }
 
 

    </style>
@if ($paginator->hasPages())
    <ul class="pagination " role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link bg-premier text-color" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link " href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active bg-warning text-dark" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif
