<div style="display: none" id="google_translate_element"></div>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false}, 'google_translate_element');
    }
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>

<!-- Flag click handler -->
<script type="text/javascript">
    $(document).on('click','.translation-links', function() {
        var lang = $(this).data('lang');
        var $frame = $('.goog-te-menu-frame:first');

        if (!$frame) {
            return false;
        }
        $frame.contents().find('.goog-te-menu2-item span.text:contains('+lang+')').get(0).click();
        return false;
    });


</script>