<footer class="pt-4 my-md-5 pt-md-5 border-top footer navbar-fixed-bottom">
    <div class="row">
        <div class="col-12 col-md">
            <small class="d-block mb-3 text-muted text-center">{{ __('site.name') }} © {{date("Y")}}.
                <br>{{ __('site.footer.title') }}</small>
        </div>
        <div class="col-6 col-md">
            <h5 class="list-unstyled text-small text-center"><a href="{{ route('site.about') }}"
                                                                class="text-dark">{{ __('site.footer.about') }}</a></h5>
        </div>
        <div class="col-6 col-md">
            <h5 class="list-unstyled text-small text-center"><a href="{{ route('site.terms-of-use') }}"
                                                                class="text-dark">{{ __('site.footer.terms-of-use') }}</a>
            </h5>
        </div>
        <div class="col-6 col-md">
            <h5 class="list-unstyled text-small text-center"><a href="{{ route('site.privacy-policy') }}"
                                                                class="text-dark">{{ __('site.footer.privacy-policy') }}</a>
            </h5>
        </div>
    </div>
</footer>
