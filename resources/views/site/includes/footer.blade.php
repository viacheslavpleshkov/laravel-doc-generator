<footer class="pt-4 my-md-5 pt-md-5 border-top footer navbar-fixed-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-3 p-2">
                <h5 class="list-unstyled text-small text-center"><a href="{{ route('site.about') }}" class="text-dark">{{ __('site.footer.about') }}</a>
                </h5>
            </div>
            <div class="col-md-12 col-lg-3 p-2">
                <h5 class="list-unstyled text-small text-center"><a href="{{ route('site.terms-of-use') }}" class="text-dark">{{ __('site.footer.terms-of-use') }}</a>
                </h5>
            </div>
            <div class="col-md-12 col-lg-3 p-2">
                <h5 class="list-unstyled text-small text-center"><a href="{{ route('site.privacy-policy') }}" class="text-dark">{{ __('site.footer.privacy-policy') }}</a>
                </h5>
            </div>
            <div class="col-md-12 col-lg-3 p-2">
                <h5 class="list-unstyled text-small text-center"><a href="{{ route('site.personaldatapolicy') }}" class="text-dark">Политика обращения с персональными
                        данными</a>
                </h5>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12 col-lg-6 p-2 text-center">
                <p>{{ __('site.name') }} © {{date("Y")}}. {{ __('site.footer.title') }}</p>
            </div>
            <div class="col-md-12 col-lg-3 p-2 text-center">
                <a href="https://t.me/vsudbezuristasupport" target="_blank" class="text-dark">Служба поддержки <i class="fab fa-telegram" style="color: #0088CC;"></i></a>
            </div>
            <div class="col-md-12 col-lg-3 p-2 text-center">
            <a href="https://t.me/vsudbezurista" target="_blank" class="text-dark">Подписаться на новости <i class="fab fa-telegram" style="color: #0088CC;"></i></a>
            </div>
        </div>
    </div>

</footer>