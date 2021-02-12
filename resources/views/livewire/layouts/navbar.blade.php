@section('navigation')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('students') }}">{{ __('message.attributes.appName') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ __('message.attributes.language') }}
                        </a>
                        <ul class="dropdown-menu language-menu" aria-labelledby="navbarDropdown">
                            <li data-locale="en">
                                <a class="dropdown-item" href="#">English</a>
                            </li>
                            <li data-locale="fa">
                                <a class="dropdown-item" href="#">پارسی</a>
                            </li>
                        </ul>
                        <form action="{{ route('changeLocale') }}" method="post" id="locale-form">
                            @csrf
                            <input type="hidden" id="locale" name="language"/>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endsection

