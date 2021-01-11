<footer class="pt-4 my-md-5 pt-md-5 border-top footer navbar-fixed-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-3 p-2">
                <h5 class="list-unstyled text-small text-center"><a href="{{ route('site.about') }}"
                                                                    class="text-dark">{{ __('site.footer.about') }}</a>
                </h5>
            </div>
            <div class="col-md-12 col-lg-3 p-2">
                <h5 class="list-unstyled text-small text-center"><a href="{{ route('site.terms-of-use') }}"
                                                                    class="text-dark">{{ __('site.footer.terms-of-use') }}</a>
                </h5>
            </div>
            <div class="col-md-12 col-lg-3 p-2">
                <h5 class="list-unstyled text-small text-center"><a href="{{ route('site.privacy-policy') }}"
                                                                    class="text-dark">{{ __('site.footer.privacy-policy') }}</a>
                </h5>
            </div>
            <div class="col-md-12 col-lg-3 p-2">
                <h5 class="list-unstyled text-small text-center"><a href="{{ route('site.personaldatapolicy') }}"
                                                                    class="text-dark">Политика обращения с персональными
                        данными</a>
                </h5>
            </div>
        </div>
        <br>
        <div class="col-12 col-md">
            <p class="d-block mb-12 text-dark text-center">{{ __('site.name') }} © {{date("Y")}}
                . {{ __('site.footer.title') }}</p>
        </div>
    </div>
</footer>
