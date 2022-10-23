<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" role="tab" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" role="tab"  href="{{route('category.index')}}">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" role="tab" href="{{route('product.index')}}">Product</a>
                </li>
            </ul>
        </div>


        <!-- Navigation Links -->
        <ul class="nav nav-tabs">
            @foreach (config('translatable.locales')::all() as $locale)
                <li class="nav-item">
                    <a class="nav-link @if (app()->getLocale() == $locale['code']) active  @endif " aria-current="page"
                       href="{{ request()->url() }}?language={{ $locale['code'] }}">

                    [{{ strtoupper($locale['code']) }}]

                    </a>
                </li>
             @endforeach
        </ul>

    </div>
</nav>


