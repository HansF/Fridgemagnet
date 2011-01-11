/*
 *
 * jquery.sound.js
 * (c) Vipin Kumar Rajput
 *
 */
(function($) {
    //
    // plugin definition
    //
    $.fn.soundPlay = function(options) {
        
        // build main options before element iteration
        var opts = $.extend({}, $.fn.soundPlay.defaults, options);
        // iterate and reformat each matched element
        if(opts.command == "play") {
            $.fn.soundPlay.play(opts);
        } else if(opts.command == "stop") {
            $.fn.soundPlay.stop(opts);
        } else {
            
        }
    };

    function debug($obj) {
        if (window.console && window.console.log)
            window.console.log('soundPlay: ' + $obj.size());
    };

    $.fn.soundPlay.play = function(opts) {
        url = opts.url;
        id = opts.playerId;
        $("body").append('<embed id="' + id + '" src="'+url+'" autostart="true" hidden="true"></embed>');
        return false;
    };
    $.fn.soundPlay.stop = function(opts) {
        $('#'+opts.playerId).remove();
        return false;
    };
    //
    // plugin defaults
    //
    $.fn.soundPlay.defaults = {
        url: '',
        playerId: 'player',
        command: 'play'
    };

})(jQuery);
