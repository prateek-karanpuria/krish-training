define([
    'jquery',
    'Magento_Ui/js/modal/modal',
    'mage/mage',
    'jquery/ui'
], function ($, modal) {
    'use strict';

    $.widget('newsletter.processPopupNewsletter', {

        /**
         *
         * @private
         */
        _create: function () {
            var self = this,
                popup_newsletter_options = {
                    type: 'popup',
                    responsive: true,
                    innerScroll: true,
                    title: this.options.popupTitle,
                    buttons: false,
                    modalClass : 'popup-newsletter',
                    clickableOverlay: false
                };

            modal(popup_newsletter_options, this.element);

            setTimeout(function() {
                if (!get_cookie('newsletter_popup_hide')) {
                    self._setStyleCss();
                    self.element.modal('openModal').on('modalclosed', function() { 
                        set_cookie("newsletter_popup_hide", true, 1440); // Set cookie for 1 day = 1440 min
                    });
                }
            }, 2000);

            this.element.find('form').submit(function() {

                if ($(this).validation('isValid')) {
                    $.ajax({
                        url: $(this).attr('action'),
                        cache: true,
                        data: $(this).serialize(),
                        dataType: 'json',
                        type: 'POST',
                        showLoader: true
                    }).done(function (data) {
                        self.element.find('.messages .message div').html(data.message);
                        self.element.find('.messages').show();

                        if (data.error) {
                            self.element.find('.messages .message').addClass('message-error error');
                        } else {
                            self.element.find('.messages .message').addClass('message-success success');

                            setTimeout(function() {
                                self.element.modal('closeModal');

                                if (!get_cookie('newsletter_popup_hide')) {
                                    set_cookie("newsletter_popup_hide", true, 1440); // Set cookie for 1 day = 1440 min
                                }

                            }, 1000);
                        }

                        setTimeout(function() {
                            self.element.find('.messages').hide();
                        }, 5000);

                    }).fail(function(data) {
                        // self.element.find('.messages .message div').html(data.message);

                        // if (data.error) {
                        //     self.element.find('.messages .message').addClass('message-error error');
                        // }
                    })
                }

                return false;
            });

            this._resetStyleCss();
        },

        /**
         * Set width of the popup
         * @private
         */
        _setStyleCss: function(width) {

            width = width || 400;

            if (window.innerWidth > 786) {
                this.element.parent().parent('.modal-inner-wrap').css({'max-width': width+'px'});
            }
        },

        /**
         * Reset width of the popup
         * @private
         */
        _resetStyleCss: function() {
            var self = this;
            $( window ).resize(function() {
                if (window.innerWidth <= 786) {
                    self.element.parent().parent('.modal-inner-wrap').css({'max-width': 'initial'});
                } else {
                    self._setStyleCss(self.options.innerWidth);
                }
            });
        },
    });

    function get_cookie(cookie) {
      var cookie_name = cookie + "=";
      var cookies = document.cookie.split(';');

      for (var key = 0; key < cookies.length; key++)
      {
        var cookie_value = cookies[key];

        while (cookie_value.charAt(0) == ' ')
        {
            cookie_value = cookie_value.substring(1);
        }

        if (cookie_value.indexOf(cookie_name) == 0)
        {
            return cookie_value.substring(cookie_name.length, cookie_value.length);
        }
      }

      return "";
    }

    function set_cookie(cookie_name, cookie_value, expiring_min) {
        var d = new Date();
        d.setTime(d.getTime() + (expiring_min*60*1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cookie_name + "=" + cookie_value + "; " + expires;
    }

    return $.newsletter.processPopupNewsletter;
});



