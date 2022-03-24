<!-- Global site tag (gtag.js) - Google Analytics -->
<script async defer src="https://www.googletagmanager.com/gtag/js?id=UA-70987327-14"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-70987327-14');
    function phone(value) {
        gtag('event', 'Enviar', {
            'event_category': 'Llamar',
            'event_label': value === 1 ? 'Llamar' :'Llamar flotante',
            'value': ''
        })
    }
    function whatssap() {
        gtag('event', 'Chat', {
            'event_category': 'Whatsapp',
            'event_label': 'Whatsapp',
            'value': ''
        })
    }
</script>
<meta name="google-site-verification" content="ACbhTZbVaScTzLZ_nGUG9o_-X3oe8K97Bj9mZeIb1O0" />
<!-- Facebook Pixel Code -->
<script>
    ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', {{env('PIXEL_FACEBOOK')}});
    fbq('track', 'PageView');

</script>
<noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id={{env('PIXEL_FACEBOOK')}}&ev=PageView&noscript=1" /></noscript>
<!-- End Facebook Pixel Code -->
