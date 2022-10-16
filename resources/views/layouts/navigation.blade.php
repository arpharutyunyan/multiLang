<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('category.index')}}">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{route('product.index')}}">Product</a>
                </li>
            </ul>
        </div>

        <!-- Navigation Links -->
        <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex">

            @foreach (config('translatable.locales')::all() as $locale)
                <a href="{{ request()->url() }}?language={{ $locale['code'] }}"
                   class="@if (app()->getLocale() == $locale['code']) border-indigo-400 @endif inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 focus:outline-none transition duration-150 ease-in-out">
                    [{{ strtoupper($locale['code']) }}]
                </a>
            @endforeach

        </div>
    </div>
</nav>


